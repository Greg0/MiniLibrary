<?php

namespace Greg0\LibraryBundle\Entity;

/**
 * Borrow
 */
class Borrow
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \stdClass
     */
    private $requestUser;

    /**
     * @var \stdClass
     */
    private $targetUser;

    /**
     * @var \stdClass
     */
    private $book;

    /**
     * @var string
     */
    private $status;


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
     * Set requestUser
     *
     * @param \stdClass $requestUser
     *
     * @return Borrow
     */
    public function setRequestUser($requestUser)
    {
        $this->requestUser = $requestUser;

        return $this;
    }

    /**
     * Get requestUser
     *
     * @return \stdClass
     */
    public function getRequestUser()
    {
        return $this->requestUser;
    }

    /**
     * Set targetUser
     *
     * @param \stdClass $targetUser
     *
     * @return Borrow
     */
    public function setTargetUser($targetUser)
    {
        $this->targetUser = $targetUser;

        return $this;
    }

    /**
     * Get targetUser
     *
     * @return \stdClass
     */
    public function getTargetUser()
    {
        return $this->targetUser;
    }

    /**
     * Set book
     *
     * @param \stdClass $book
     *
     * @return Borrow
     */
    public function setBook($book)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \stdClass
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Borrow
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}

