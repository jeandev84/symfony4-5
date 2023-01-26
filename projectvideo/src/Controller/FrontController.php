<?php
namespace App\Controller;

use App\Controller\Traits\Likes;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Video;
use App\Form\UserType;
use App\Repository\VideoRepository;
use App\Utils\CategoryTreeFrontPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Utils\VideoForNoValidSubscription;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Utils\Interfaces\CacheInterface;




class FrontController extends AbstractController
{

    use Likes;


    /**
     * @Route("/", name="main_page")
    */
    public function index(): Response
    {
        return $this->render('front/index.html.twig');
    }



    /**
     * @Route("/video-list/category/{categoryname},{id}/{page}", defaults={"page": "1"}, name="video_list")
     */
    public function videoList(
        $id,
        $page,
        CategoryTreeFrontPage $categoryTree,
        Request $request,
        VideoForNoValidSubscription $video_no_members,
        CacheInterface $cache
    ): Response
    {

        /*
         $subcategories = $categoryTree->buildTree($id);
         dump($subcategories);

         $categoryTree->getCategoryListAndParent($id); // dump($categoryTree);

         $ids = $categoryTree->getChildIds($id);

         array_push($ids, $id);

         $videos = $this->getDoctrine()
                      ->getRepository(Video::class)
                      ->findByChilds($ids, $page, $request->get('sortBy'));


          return $this->render('front/video_list.html.twig', [
               //'subcategories' => $categoryTree->getCategoryList($subcategories),
               'subcategories'    => $categoryTree,
               'videos'           => $videos,
               'video_no_members' => $video_no_members->check()
           ]);
        */


        $cache = $cache->cache;
          $videoList = $cache->getItem('video_list'. $id.$page.$request->get('sortby'));
          // $videoList->tag(['video_list']);
          $videoList->expiresAfter(60);

          if (! $videoList->isHit()) {

                  $ids = $categoryTree->getChildIds($id);
                  array_push($ids, $id);

                  $videos = $this->getDoctrine()
                      ->getRepository(Video::class)
                      ->findByChilds($ids, $page, $request->get('sortBy'));

                  $categoryTree->getCategoryListAndParent($id);
                  $response = $this->render('front/video_list.html.twig', [
                      'subcategories'    => $categoryTree,
                      'videos'           => $videos,
                      'video_no_members' => $video_no_members->check()
                  ]);

                  $videoList->set($response);
                  $cache->save($videoList);
          }


          return $videoList->get();
    }



    /**
     * @Route("/video-details/{video}", name="video_details")
    */
    public function videoDetails(VideoRepository $repository, $video, VideoForNoValidSubscription $video_no_members): Response
    {
        /* dump($repository->videoDetails($video)); */


        return $this->render('front/video_details.html.twig', [
             'video' => $repository->videoDetails($video),
             'video_no_members' => $video_no_members->check()
        ]);
    }



    /**
     * @Route("/search-results/{page}", methods={"GET"}, defaults={"page": "1"}, name="search_results")
     */
    public function searchResults($page, Request $request): Response
    {
        $videos = null;
        $query  = null;
        if ($query = $request->get('query')) {
             $videos = $this->getDoctrine()
                            ->getRepository(Video::class)
                            ->findByTitle($query, $page, $request->get('sortBy'));

             if (! $videos->getItems()) $videos = null;
        }

        return $this->render('front/search_results.html.twig', [
             'videos' => $videos,
             'query'  => $query
        ]);
    }





    /**
     * @Route("/new-comment/{video}", methods={"POST"}, name="new_comment")
     * @return mixed
    */
    public function newComment(Video $video, Request $request)
    {
           // Block access to add Comment if user is not authenticated
           $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

           if (! empty(trim($request->request->get('comment')))) {

                 $comment = new Comment();
                 $comment->setContent($request->request->get('comment'));
                 $comment->setUser($this->getUser());
                 $comment->setVideo($video);

                 $em = $this->getDoctrine()->getManager();
                 $em->persist($comment);
                 $em->flush();
           }

           return $this->redirectToRoute('video_details', [
               'video' => $video->getId()
           ]);
    }





    /**
     * @Route("/delete-comment/{comment}", name="delete_comment")
     * @Security("user.getId() == comment.getUser().getId()")
    */
    public function deleteComment(Comment $comment, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));
    }






    /**
     * @Route("/video-list/{video}/like", name="like_video", methods={"POST"})
     * @Route("/video-list/{video}/dislike", name="dislike_video", methods={"POST"})
     * @Route("/video-list/{video}/unlike", name="undo_like_video", methods={"POST"})
     * @Route("/video-list/{video}/unlike", name="undo_dislike_video", methods={"POST"})
    */
    public function toggleLikesAjax(Video $video, Request $request)
    {
        // Block access to likes / dislikes if user is not authenticated
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        switch ($request->get('_route')) {
            case 'like_video':
                $result = $this->likeVideo($video);
            break;
            case 'dislike_video':
                $result = $this->dislikeVideo($video);
                break;
            case 'undo_like_video':
                $result = $this->undoLikeVideo($video);
                break;
            case 'undo_dislike_video':
                $result = $this->undoDislikeVideo($video);
                break;
        }


        return $this->json([
            'action' => $result, // result for JS (./assets/js/likes.js) where switching
            'id'     => $video->getId()
        ]);
    }



    /**
     * Rendering main categories (to see inside the twig file corresponded)
     * something like render(controller(FrontController::mainCategories()))
     *
     * @return Response
    */
    public function mainCategories()
    {
         $categories = $this->getDoctrine()
                            ->getRepository(Category::class)
                            ->findBy(['parent' => null], ['name' => 'ASC']);

         return $this->render('front/widgets/_main_categories.html.twig', [
              'categories' => $categories
         ]);
    }
}
