<?php

namespace AppBundle\DataFixtures\Tests;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements  FixtureInterface {

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('testadmin');
        $userAdmin->setPassword('testadmin');
        $userAdmin->setEmail('test@cogax.ch');
        $userAdmin->setEnabled(true);

        $manager->persist($userAdmin);
        $manager->flush();
    }
}