<?php

namespace Greg0\LibraryBundle\Entity;

use \FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $books;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $groups;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $outgoingBorrows;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $incomingBorrows;

    /** @var string */
    protected $firstName;

    /** @var string */
    protected $lastName;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bookVersion
     *
     * @param \Greg0\LibraryBundle\Entity\Book $bookVersion
     *
     * @return User
     */
    public function addBook(\Greg0\LibraryBundle\Entity\Book $bookVersion)
    {
        $this->books[] = $bookVersion;

        return $this;
    }

    /**
     * Remove bookVersion
     *
     * @param \Greg0\LibraryBundle\Entity\Book $bookVersion
     */
    public function removeBook(\Greg0\LibraryBundle\Entity\Book $bookVersion)
    {
        $this->books->removeElement($bookVersion);
    }

    /**
     * Get bookVersion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }

    public function getFullName()
    {
        if (empty($this->getFirstName()) == false && empty($this->getLastName()) == false)
        {
            return $this->getFirstName().' '.$this->getLastName();
        }
        return $this->getUsername();
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOutgoingBorrows()
    {
        return $this->outgoingBorrows;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIncomingBorrows()
    {
        return $this->incomingBorrows;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }



}
