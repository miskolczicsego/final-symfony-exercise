<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 15.
 * Time: 0:07
 */

namespace JobZ\HomeBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JobZ\HomeBundle\Entity\Category;

class Categories extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $c1 = new Category();
        $c1->setName('Programming');

        $c2 = new Category();
        $c2->setName('WebDesign');

        $manager->persist($c1);
        $manager->persist($c2);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 5;
    }
}