<?php

namespace Greg0\LibraryBundle\Entity;

/**
 * Report
 */
class Report
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $author;

    /**
     * @var Book
     */
    private $book;

    /**
     * @var string
     */
    private $message;

    /** @var bool */
    private $verified;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set author
     *
     * @param User $author
     *
     * @return Report
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set book
     *
     * @param Book $book
     *
     * @return Report
     */
    public function setBook($book)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Report
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return boolean
     */
    public function isVerified()
    {
        return $this->verified;
    }

    /**
     * @param boolean $verified
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
    }


}

