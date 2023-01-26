<?php
namespace App\Repository;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;




/**
 * @extends ServiceEntityRepository<Video>
 *
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{


    /**
     * @var PaginatorInterface
    */
    protected $paginator;


    /**
     * @param ManagerRegistry $registry
     * @param PaginatorInterface $paginator
    */
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
          parent::__construct($registry, Video::class);
          $this->paginator = $paginator;
    }



    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Video $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }




    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Video $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    /**
     * @param array $categoryIds
     * @param int $page
     * @param string|null $sortBy
     * @return PaginationInterface
     */
    public function findByChilds(array $categoryIds, int $page, ?string $sortBy)
    {
        /* $sortBy = ($sortBy != 'rating' ? $sortBy : 'ASC'); */

        if ($sortBy != 'rating') {
            $dbquery = $this->createQueryBuilder('v')
                ->andWhere('v.category IN (:categoryIds)')
                ->leftJoin('v.comments', 'c')
                //->addSelect('c')
                ->leftJoin('v.usersThatLike', 'l')
                ->leftJoin('v.usersThatDontLike', 'd')
                ->addSelect('c', 'l', 'd')
                ->setParameter('categoryIds', $categoryIds)
                ->orderBy('v.title', $sortBy);
        } else {
            $dbquery = $this->createQueryBuilder('v')
                            ->addSelect('COUNT(l) AS HIDDEN likes')
                            ->leftJoin('v.usersThatLike', 'l')
                            ->andWhere('v.category IN (:categoryIds)')
                            ->setParameter('categoryIds', $categoryIds)
                            ->groupBy('v')
                            ->orderBy('likes', 'DESC');
        }

        /*
        $qb = $dbquery->getQuery();
         dump($qb->getResult());
        */

        $pagination = $this->paginator->paginate($dbquery, $page, Video::perPage);

        return $pagination;
    }


    /**
     * @param string $query (search : family movies romantic)
     * @param int $page
     * @param string|null $sortBy
     * @return PaginationInterface
     */
    public function findByTitle(string $query, int $page, ?string $sortBy)
    {
        /* $sortBy = ($sortBy != 'rating' ? $sortBy : 'ASC'); */


        $queryBuilder = $this->createQueryBuilder('v');
        $searchTerms  = $this->prepareQuery($query);


        foreach ($searchTerms as $key => $term) {
             $queryBuilder->orWhere('v.title LIKE :t_'. $key)
                          ->setParameter('t_'. $key, '%'. trim($term) . '%');
        }


        if ($sortBy != 'rating') {
            $dbquery = $queryBuilder->orderBy('v.title', $sortBy)
                                    ->leftJoin('v.comments', 'c')
                                    ->leftJoin('v.usersThatLike', 'l')
                                    ->leftJoin('v.usersThatDontLike', 'd')
                                    ->addSelect('c', 'l', 'd')
                                    ->getQuery();

        } else {
            $dbquery = $queryBuilder->addSelect('COUNT(l) AS HIDDEN likes', 'c')
                                    ->leftJoin('v.usersThatLike', 'l')
                                    ->leftJoin('v.comments', 'c')
                                    ->groupBy('v', 'c')
                                    ->orderBy('likes', 'DESC')
                                    ->getQuery()
            ;
        }


        return $this->paginator->paginate($dbquery, $page, Video::perPage);
    }






    /**
     * @param string $query (check in html search bar : family movies romantic )
     * @return string[]     will bee return array ['family', 'movies', 'romantic']
    */
    protected function prepareQuery(string $query)
    {
         $terms = array_unique(explode(' ', $query));

         return array_filter($terms, function ($term) {
              return 2 <= mb_strlen($term);
         });
    }




    /**
     * Return video details and related object
     *
     *
     * @param $id
     * @return float|int|mixed|string|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function videoDetails($id)
    {
        return $this->createQueryBuilder('v')
                    ->leftJoin('v.comments', 'c')
                    ->leftJoin('c.user', 'u')
                    ->addSelect('c', 'u')
                    ->where('v.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()
                    ->getOneOrNullResult()
            ;
    }




    // /**
    //  * @return Video[] Returns an array of Video objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Video
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
