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
    private $bookVersion;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->bookVersion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bookVersion
     *
     * @param \Greg0\LibraryBundle\Entity\BookVersion $bookVersion
     *
     * @return User
     */
    public function addBookVersion(\Greg0\LibraryBundle\Entity\BookVersion $bookVersion)
    {
        $this->bookVersion[] = $bookVersion;

        return $this;
    }

    /**
     * Remove bookVersion
     *
     * @param \Greg0\LibraryBundle\Entity\BookVersion $bookVersion
     */
    public function removeBookVersion(\Greg0\LibraryBundle\Entity\BookVersion $bookVersion)
    {
        $this->bookVersion->removeElement($bookVersion);
    }

    /**
     * Get bookVersion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookVersion()
    {
        return $this->bookVersion;
    }
}
