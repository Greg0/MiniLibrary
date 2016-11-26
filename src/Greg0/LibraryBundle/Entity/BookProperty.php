<?php

namespace Greg0\LibraryBundle\Entity;

/**
 * BookProperty
 */
class BookProperty
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bookVersion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bookVersion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return BookProperty
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
     * Add bookVersion
     *
     * @param \Greg0\LibraryBundle\Entity\BookVersion $bookVersion
     *
     * @return BookProperty
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

