<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 22.12.16
 * Time: 19:43
 */
namespace ProductBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CategoryBundle\Entity\Category;
use ProductBundle\Entity\Product;

/**
 * Class LoadProductData are used to load a set of product data into database,
 * and used for testing or could be initial data required for the application to run smoothly.
 *
 * @package ProductBundle\DataFixtures\ORM
 */
class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Allow you to run creating fixture
     * 
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Samsung');

        $product = new Product();
        $product->setName('Galaxy S7');
        $product->setPrice(2000);
        $product->setDescription('Breaking boundaries and making bold steps, reached a new level of progress. Combining sophisticated design and outstanding functionality. To your attention opportunities that did not exist before in smartphones, but without which soon you won\'t be able to do.');
        $product->setImageName('587e098310f8a.jpg');
        $product->addCategory($category);

        $manager->persist($product);

        $category = new Category();
        $category->setName('Apple');

        $product = new Product();
        $product->setName('Iphone 7');
        $product->setPrice(2000);
        $product->setDescription('iPhone 7 to a new level of innovation and precision. Unique color "black onyx". Casing with protection from splashes and water. Completely redesigned Home button, and the new one-piece unibody design. From the first sight and first touch you know how much he\'s great.');
        $product->setImageName('587e09ed00d36.jpg');
        $product->addCategory($category);

        $manager->persist($product);

        $category = new Category();
        $category->setName('Meizu');
        $product = new Product();
        $product->setName('Pro 6');
        $product->setPrice(2000);
        $product->setDescription('Pro – means the vision and the desire to go to it. Meizu Pro 6 uses a completely new design language and explores the beauty of curves. All-metal enclosure is available in three colors: silver, gold, and black. For the first time in smartphone use innovative multi-tone ring flash. Introducing a fresh look, drawing on the best practices of the past, Meizu Pro 6 – the next stage on the path to perfection.');
        $product->setImageName('587e0a0d2c0d7.jpg');
        $product->addCategory($category);

        $manager->persist($product);
        
        $category = new Category();
        $category->setName('Microsoft');
        $product = new Product();
        $product->setName('Lumia 950');
        $product->setPrice(2000);
        $product->setDescription('The most powerful Microsoft smartphone has an OCTA-core processor and a Quad HD display with a diagonal of 5.7 inches. So this "beast" we never went hungry, it equipped with large capacity battery, wireless and fast charging via the USB socket C. Demanding applications, serious games and tools: Lumia 950 XL Dual SIM easy to cope with tasks of any complexity');
        $product->setImageName('587e19f98bbf2.jpg');
        $product->addCategory($category);

        $manager->persist($product);
        $manager->flush();
    }

    /**
     * Allowing to set order in which fixtures are loaded
     * 
     * @return int
     */
    public function getOrder()
    {
        return 6;
    }
}