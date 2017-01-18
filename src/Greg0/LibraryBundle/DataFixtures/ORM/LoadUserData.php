<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 18.01.2017
 * Time: 21:11
 */

namespace Greg0\LibraryBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Greg0\LibraryBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $adminGroup = $this->getReference('admin-group');
        $userGroup = $this->getReference('user-group');

        $userAdmin = $userManager->createUser();
        $userAdmin->setUsername('admin');
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setEmail('admin@mlib.local');
        $userAdmin->setEnabled(true);
        $userAdmin->setSuperAdmin(true);
        $userAdmin->addGroup($adminGroup);

        $userManager->updateUser($userAdmin);


        $user1 = $userManager->createUser();
        $user1->setUsername('user1');
        $user1->setPlainPassword('user1');
        $user1->setEmail('user1@mlib.local');
        $user1->setEnabled(true);
        $user1->addGroup($userGroup);
        $user1->addBook($this->getReference('book1'));
        $user1->addBook($this->getReference('book2'));
        $user1->addBook($this->getReference('book4'));
        $user1->addBook($this->getReference('book9'));
        $user1->addBook($this->getReference('book8'));
        $user1->addBook($this->getReference('book12'));
        $user1->addBook($this->getReference('book10'));
        $userManager->updateUser($user1);

        $user2 =$userManager->createUser();
        $user2->setUsername('user2');
        $user2->setPlainPassword('user2');
        $user2->setEmail('user2@mlib.local');
        $user2->setEnabled(true);
        $user2->addGroup($userGroup);
        $user2->addBook($this->getReference('book3'));
        $user2->addBook($this->getReference('book5'));
        $user2->addBook($this->getReference('book16'));
        $user2->addBook($this->getReference('book10'));
        $userManager->updateUser($user2);

        $user3 = $userManager->createUser();
        $user3->setUsername('user3');
        $user3->setPlainPassword('user3');
        $user3->setEmail('user3@mlib.local');
        $user2->setEnabled(true);
        $user3->addGroup($userGroup);
        $user3->addBook($this->getReference('book2'));
        $user3->addBook($this->getReference('book5'));
        $user3->addBook($this->getReference('book7'));
        $user3->addBook($this->getReference('book12'));
        $user3->addBook($this->getReference('book15'));
        $userManager->updateUser($user3);


        $this->addReference('admin-user', $userAdmin);
        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
        $this->addReference('user3', $user3);
    }



    public function getOrder()
    {
        return 4;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}