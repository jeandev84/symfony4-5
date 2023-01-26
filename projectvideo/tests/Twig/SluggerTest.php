<?php
namespace App\Tests\Twig;

use PHPUnit\Framework\TestCase;
use App\Twig\AppExtension;


class SluggerTest extends TestCase
{

    /**
     * @dataProvider getSlugs
    */
    public function testSlugify(string $string, string $slug): void
    {
        $slugger = new AppExtension();

        /* $this->assertSame('cell-phones', $slugger->slugify('Cell Phones')); */

        $this->assertSame($slug, $slugger->slugify($string));
    }




    public function getSlugs()
    {
         /*
         return [
            ['Cell Phones', 'cell-phones'],
            ['Lorem Ipsum', 'lorem-ipsum'], // replace space to dash (-)
            [' Lorem Ipsum', 'lorem-ipsum'], // trim text
         ];

         OR
         */

         yield ['Lorem Ipsum', 'lorem-ipsum'];
         yield [' Lorem Ipsum', 'lorem-ipsum'];
         yield [' lorEm iPsUm', 'lorem-ipsum'];
         yield ['!Lorem Ipsum!', 'lorem-ipsum'];
         yield ['lorem-ipsum', 'lorem-ipsum'];
         yield ['Children\'s books', 'childrens-books'];
         yield ['Five star movies', 'five-star-movies'];
         yield ['Adults 60+', 'adults-60'];
    }
}
