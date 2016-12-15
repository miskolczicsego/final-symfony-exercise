<?php

namespace JobZ\HomeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use JobZ\HomeBundle\Entity\Job;

/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 14.
 * Time: 23:08
 */
class Jobs extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $j1 = new Job();
        $j1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a nisl eu tellus aliquam tempus. Nunc pulvinar mollis mi, eu ultricies arcu tristique vitae. Quisque convallis luctus nisi, ac ultricies turpis cursus vel. Phasellus accumsan tempus molestie. Integer sollicitudin nibh magna, sed condimentum nisl commodo quis. Proin ullamcorper euismod felis.');
        $j1->setEmail('example@example.com');
        $j1->setLocation('Debrecen');
        $j1->setPosition('Web developer');
        $j1->setTitle('Teszt állás');
        $j1->setStatus('1');
        $j1->setType('freelance');
        $j1->setCompany('Example Ltd');
        $j1->setUrl('http://www.examplejobs.com');
        $j1->setApply('http://www.jobapply.com/apply');
        $j1->setCategory($this->getCategory($manager, 'Programming'));


        $j2 = new Job();
        $j2->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a nisl eu tellus aliquam tempus. Nunc pulvinar mollis mi, eu ultricies arcu tristique vitae. Quisque convallis luctus nisi, ac ultricies turpis cursus vel. Phasellus accumsan tempus molestie. Integer sollicitudin nibh magna, sed condimentum nisl commodo quis. Proin ullamcorper euismod felis.');
        $j2->setEmail('chill@example.com');
        $j2->setLocation('Budapest');
        $j2->setPosition('Dev-ops');
        $j2->setTitle('Teszt állás2');
        $j2->setStatus('0');
        $j2->setType('part-time');
        $j2->setCompany('Chill Co.');
        $j2->setUrl('http://www.chillwork.com');
        $j2->setApply('http://www.jobapply.com/apply');
        $j2->setCategory($this->getCategory($manager, 'Programming'));

        $j3 = new Job();
        $j3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a nisl eu tellus aliquam tempus. Nunc pulvinar mollis mi, eu ultricies arcu tristique vitae. Quisque convallis luctus nisi, ac ultricies turpis cursus vel. Phasellus accumsan tempus molestie. Integer sollicitudin nibh magna, sed condimentum nisl commodo quis. Proin ullamcorper euismod felis.');
        $j3->setEmail('example@example.com');
        $j3->setLocation('Eger');
        $j3->setPosition('Sitebuilder');
        $j3->setTitle('Teszt állás3');
        $j3->setStatus('1');
        $j3->setType('full-time');
        $j3->setCompany('Own the world');
        $j3->setUrl('http://www.bestcompanyintheworld.com');
        $j3->setApply('http://www.jobapply.com/apply');
        $j3->setCategory($this->getCategory($manager, 'WebDesign'));

        $manager->persist($j1);
        $manager->persist($j2);
        $manager->persist($j3);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 10;
    }

    private function getCategory($manager, $name)
    {
        return $manager->getRepository('HomeBundle:Category')->findOneBy(
            array(
                'name' => $name
            )
        );
    }
}