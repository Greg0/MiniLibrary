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
}
