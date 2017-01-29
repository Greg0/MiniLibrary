<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 18.01.2017
 * Time: 23:11
 */

namespace Greg0\LibraryBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Greg0\LibraryBundle\Entity\Book;

class LoadBookData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $book = [];

        $tempBook = new Book();
        $tempBook->setTitle('Ręka mistrza');
        $tempBook->setShortDescription('Najlepsza od lat książka mistrza grozy Stephena Kinga! Ręka mistrza to nie tylko znakomity horror, ale też rewelacyjna powieść psychologiczna.');
        $tempBook->addAuthor($this->getReference('author1'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Bazar złych snów');
        $tempBook->setShortDescription('Książka nagrodzona tytułem Książki Roku 2015 lubimyczytać.pl w kategorii Horror');
        $tempBook->addAuthor($this->getReference('author1'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Cztery pory roku');
        $tempBook->setShortDescription('Najsłynniejsza z nich – Skazani na Shawshank z Timem Robbinsem i Morganem Freemanem – otrzymała aż 7 nominacji do Oscarów. ');
        $tempBook->addAuthor($this->getReference('author1'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Historia Dziadka do orzechów');
        $tempBook->setShortDescription('Utrzymana w baśniowej, fantastycznej konwencji, opowiada o przygodach małej Klary w świecie, w którym zabawki ożywają, a księciem ich królestwa zostaje tytułowy Dziadek do Orzechów.');
        $tempBook->addAuthor($this->getReference('author2'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Hrabia Monte Christo');
        $tempBook->setShortDescription('Genialne dzieło Dumasa to wciąż niedościgniony pierwowzór opowieści o wielkiej intrydze, sile zemsty, potędze przyjaźni i triumfie człowieka w walce o honor');
        $tempBook->addAuthor($this->getReference('author2'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Kawaler d\'Harmental');
        $tempBook->setShortDescription('Młody szlachcic francuski Raul d\'Harmental pojawia się na dworze Ludwika XIV, na krótko przed śmiercią króla.');
        $tempBook->addAuthor($this->getReference('author2'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Władca Pierścieni');
        $tempBook->setShortDescription('Niełatwo powiedzieć, na czym polega tajemnica uroku wywieranego przez Władcę Pierścieni.');
        $tempBook->addAuthor($this->getReference('author3'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Dzieci Húrina');
        $tempBook->setShortDescription('Dzieło, nad którym Tolkien pracował przez całe życie, doczekało się pierwszego wydania w ponad 30 lat od śmierci jednego z największych pisarzy XX wieku. ');
        $tempBook->addAuthor($this->getReference('author3'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Hobbit');
        $tempBook->setShortDescription('Pierwsza książka Tolkiena zdobyła tak ogromną popularność, że dziś trudno wręcz spotkać kogoś, kto nie słyszałby o hobbitach.');
        $tempBook->addAuthor($this->getReference('author3'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Księga zaginionych opowieści');
        $tempBook->setShortDescription('Napisana przed około siedemdziesięciu laty "Księga zaginionych opowieści" stanowiła najwcześniejsze liczące się dokonanie J.R.R. Tolkiena w dziedzinie literatury fantastycznej.');
        $tempBook->addAuthor($this->getReference('author3'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Harry Potter');
        $tempBook->setShortDescription('O czarodziejach i perypetiach magicznych');
        $tempBook->addAuthor($this->getReference('author4'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Folwark zwierzęcy');
        $tempBook->setShortDescription('Orwell pisał: "Folwark Zwierzęcy miał być przede wszystkim satyrą na rewolucję rosyjską.');
        $tempBook->addAuthor($this->getReference('author5'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Brak tchu');
        $tempBook->setShortDescription('Powieść często uznawana za najlepsze dzieło autora Folwarku zwierzęcego i Roku 1984, przełożona na kilkadziesiąt języków!');
        $tempBook->addAuthor($this->getReference('author5'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Eseje');
        $tempBook->setShortDescription('Miarą wielkości Orwella jako intelektualisty jest fakt, że dla poznania jego myśli i postawy wobec świata znacznie użyteczniejsze są jego własne teksty niż cudze interpretacje i komentarze. ');
        $tempBook->addAuthor($this->getReference('author5'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Bellew Zawierucha');
        $tempBook->setShortDescription('Kit Bellew otrzymuje od stryja propozycję wyjazdu do Klondike krainy złota i dzikiej przygody.');
        $tempBook->addAuthor($this->getReference('author6'));
        $book[] = $tempBook;

        $tempBook = new Book();
        $tempBook->setTitle('Biały Kieł');
        $tempBook->setShortDescription('Czy dzikie zwierzę może stać się wiernym przyjacielem człowieka? Tak, jeśli człowiek, w którego ręce się dostaje potrafi okazać zwierzęciu miłość i otoczyć je troskliwą opieką');
        $tempBook->addAuthor($this->getReference('author6'));
        $book[] = $tempBook;

        foreach ($book as $key => $item)
        {
            $manager->persist($item);
            $this->addReference('book' . ($key + 1), $item);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}