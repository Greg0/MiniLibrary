<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 18.01.2017
 * Time: 23:03
 */

namespace Greg0\LibraryBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Greg0\LibraryBundle\Entity\Author;

class LoadAuthorData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $author1 = new Author();
        $author1->setFirstName('Stephen');
        $author1->setLastName('King');

        $author2 = new Author();
        $author2->setFirstName('Aleksander');
        $author2->setLastName('Dumas');

        $author3 = new Author();
        $author3->setFirstName('J.R.R.');
        $author3->setLastName('Tolkien');

        $author4 = new Author();
        $author4->setFirstName('J.K.');
        $author4->setLastName('Rowling');

        $author5 = new Author();
        $author5->setFirstName('George');
        $author5->setLastName('Orwell');

        $author6 = new Author();
        $author6->setFirstName('Jack');
        $author6->setLastName('London');

        $manager->persist($author1);
        $manager->persist($author2);
        $manager->persist($author3);
        $manager->persist($author4);
        $manager->persist($author5);
        $manager->persist($author6);

        $manager->flush();


        $this->addReference('author1', $author1);
        $this->addReference('author2', $author2);
        $this->addReference('author3', $author3);
        $this->addReference('author4', $author4);
        $this->addReference('author5', $author5);
        $this->addReference('author6', $author6);
    }

    public function getOrder()
    {
        return 1;
    }
}