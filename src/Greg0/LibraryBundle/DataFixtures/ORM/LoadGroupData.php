<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 18.01.2017
 * Time: 21:18
 */

namespace Greg0\LibraryBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Greg0\LibraryBundle\Entity\Group;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $groupAdmin = new Group('admin');
        $groupAdmin->addRole('ROLE_ADMIN');
        $manager->persist($groupAdmin);

        $groupUser = new Group('user');
        $groupUser->addRole('ROLE_ADMIN');
        $manager->persist($groupUser);

        $manager->flush();

        $this->addReference('admin-group', $groupAdmin);
        $this->addReference('user-group', $groupUser);
    }

    public function getOrder()
    {
        return 3;
    }
}