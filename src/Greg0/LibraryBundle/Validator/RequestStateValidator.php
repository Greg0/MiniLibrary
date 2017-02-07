<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 22.01.2017
 * Time: 11:31
 */

namespace Greg0\LibraryBundle\Validator;


use Greg0\LibraryBundle\Entity\Borrow;
use Greg0\LibraryBundle\Entity\User;

class RequestStateValidator
{
    /** @var Borrow */
    private $request;

    /**
     * RequestStateValidator constructor.
     * @param Borrow $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getAvailableStatesToChangeForUser(User $user)
    {
        $availableStates = [];
        if ($user->getId() == $this->request->getRequestUser()->getId())
        {
            if ($this->request->isWaiting() || $this->request->isRefused())
            {
                $availableStates[] = Borrow::STATUS_CLOSED;
            }
        } elseif ($user->getId() == $this->request->getTargetUser()->getId())
        {
            if ($this->request->isWaiting())
            {
                $availableStates[] = Borrow::STATUS_ACCEPTED;
                $availableStates[] = Borrow::STATUS_REFUSED;
            } elseif ($this->request->isAccepted())
            {
                $availableStates[] = Borrow::STATUS_BORROWED;
            } elseif ($this->request->isBorrowed())
            {
                $availableStates[] = Borrow::STATUS_CLOSED;
            }
        }

        return $availableStates;
    }
}