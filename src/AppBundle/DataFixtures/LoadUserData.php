<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use AppBundle\Entity\UserGroup;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements  FixtureInterface {

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        // Inventor group
        $inventorGroup = new UserGroup('inventor', array('ROLE_VISITOR', 'ROLE_INVENTOR'));
        $manager->persist($inventorGroup);
        $manager->flush();

        // Inventor user
        $inventorUser = new User();
        $inventorUser->setUsername('inventor');
        $inventorUser->setPlainPassword('inventor');
        $inventorUser->setEmail('inventor@cogax.ch');
        $inventorUser->setEnabled(true);
        $inventorUser->addGroup($inventorGroup);
        $manager->persist($inventorUser);
        $manager->flush();

        // Visitor Group
        $visitorGroup = new UserGroup('visitor', array('ROLE_VISITOR'));
        $manager->persist($visitorGroup);
        $manager->flush();

        // Visitor User
        $visitorUser = new User();
        $visitorUser->setUsername('visitor');
        $visitorUser->setPlainPassword('visitor');
        $visitorUser->setEmail('visitor@cogax.ch');
        $visitorUser->setEnabled(true);
        $visitorUser->addGroup($visitorGroup);
        $manager->persist($visitorUser);
        $manager->flush();
    }
}