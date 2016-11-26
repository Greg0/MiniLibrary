<?php

namespace Greg0\LibraryBundle\Entity;

/**
 * BookVersion
 */
class BookVersion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Greg0\LibraryBundle\Entity\Book
     */
    private $book;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bookProperty;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bookProperty = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return BookVersion
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set book
     *
     * @param \Greg0\LibraryBundle\Entity\Book $book
     *
     * @return BookVersion
     */
    public function setBook(\Greg0\LibraryBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \Greg0\LibraryBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Add bookProperty
     *
     * @param \Greg0\LibraryBundle\Entity\BookProperty $bookProperty
     *
     * @return BookVersion
     */
    public function addBookProperty(\Greg0\LibraryBundle\Entity\BookProperty $bookProperty)
    {
        $this->bookProperty[] = $bookProperty;

        return $this;
    }

    /**
     * Remove bookProperty
     *
     * @param \Greg0\LibraryBundle\Entity\BookProperty $bookProperty
     */
    public function removeBookProperty(\Greg0\LibraryBundle\Entity\BookProperty $bookProperty)
    {
        $this->bookProperty->removeElement($bookProperty);
    }

    /**
     * Get bookProperty
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookProperty()
    {
        return $this->bookProperty;
    }

    /**
     * @param User $user
     * @return BookVersion
     */
    public function addUser(User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * @param User $user
     */
    public function removeUser(User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

