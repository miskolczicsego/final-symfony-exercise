<?php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use JobZ\HomeBundle\Entity\User;

/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 15.
 * Time: 23:48
 */
class Users extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $u1 = new User();
        $u1->setName('Csegő');
        $u1->setUsername('csigusz');
        $u1->setEmail('csego@example.com');
        $u1->setPassword('1111');
        $u1->setPlainPassword('1111');

        $manager->persist($u1);
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