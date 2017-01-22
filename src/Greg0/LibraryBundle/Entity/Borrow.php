<?php

namespace Greg0\LibraryBundle\Entity;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Greg0\LibraryBundle\Validator\RequestStateValidator;

/**
 * Borrow
 */
class Borrow
{
    const STATUS_WAITING  = 'waiting';
    const STATUS_REFUSED  = 'refused';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_BORROWED = 'borrowed';
    const STATUS_CLOSED   = 'closed';

    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $requestUser;

    /**
     * @var User
     */
    private $targetUser;

    /**
     * @var Book
     */
    private $book;

    /**
     * @var string
     */
    private $status;

    /** @var boolean */
    private $archived;


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
     * @param User $requestUser
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
     * @return User
     */
    public function getRequestUser()
    {
        return $this->requestUser;
    }

    /**
     * Set targetUser
     *
     * @param User $targetUser
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
     * @return User
     */
    public function getTargetUser()
    {
        return $this->targetUser;
    }

    /**
     * Set book
     *
     * @param Book $book
     *
     * @return Borrow
     */
    public function setBook(Book $book)
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

    /**
     * @return array
     */
    public static function getAllStates()
    {
        return [
            Borrow::STATUS_WAITING,
            Borrow::STATUS_REFUSED,
            Borrow::STATUS_ACCEPTED,
            Borrow::STATUS_BORROWED,
            Borrow::STATUS_CLOSED,
        ];
    }

    /**
     * @return boolean
     */
    public function isArchived()
    {
        return $this->archived;
    }

    /**
     * @param boolean $archived
     */
    public function setIsArchived($archived)
    {
        $this->archived = $archived;
    }


    /**
     * @return bool
     */
    public function isWaiting()
    {
        return $this->getStatus() == Borrow::STATUS_WAITING;
    }

    /**
     * @return bool
     */
    public function isRefused()
    {
        return $this->getStatus() == Borrow::STATUS_REFUSED;
    }

    /**
     * @return bool
     */
    public function isAccepted()
    {
        return $this->getStatus() == Borrow::STATUS_ACCEPTED;
    }

    /**
     * @return bool
     */
    public function isBorrowed()
    {
        return $this->getStatus() == Borrow::STATUS_BORROWED;
    }

    /**
     * @return bool
     */
    public function isClosed()
    {
        return $this->getStatus() == Borrow::STATUS_CLOSED;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getAvailableStatesForUser(User $user)
    {
        $validator = new RequestStateValidator($this);

        return $validator->getAvailableStatesToChangeForUser($user);
    }

    public function checkUniqueOnPrePersist(LifecycleEventArgs $eventArgs)
    {
        if ($this->isClosed() == false)
        {
            $borrows = $eventArgs->getObjectManager()->getRepository('LibraryBundle:Borrow')->findBy([
                'book'        => $this->book,
                'requestUser' => $this->requestUser,
                'archived'    => 0,
            ]);

            if (count($borrows))
            {
                throw new \Exception('');
            }
        }

    }
}

