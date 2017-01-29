<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 22.01.2017
 * Time: 11:11
 */

namespace Greg0\LibraryBundle\Util;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Greg0\LibraryBundle\Entity\Borrow;
use Greg0\LibraryBundle\Entity\User;
use Greg0\LibraryBundle\Validator\RequestStateValidator;

class RequestStateChanger
{
    /** @var Borrow */
    private $request;

    /** @var ObjectManager */
    private $entityManager;

    /**
     * RequestStateChanger constructor.
     * @param Borrow $request
     * @param ObjectManager $entityManager
     */
    public function __construct(Borrow $request, ObjectManager $entityManager)
    {
        $this->request       = $request;
        $this->entityManager = $entityManager;
    }

    /**
     * @param User $user
     * @param $state
     * @return bool
     */
    public function changeStateTo(User $user, $state)
    {
        if (in_array($state, Borrow::getAllStates()) == false)
        {
            return false;
        }

        if ($this->hasPrivileges($user, $state))
        {
            if ($state == Borrow::STATUS_CLOSED)
            {
                $this->request->setIsArchived(true);
            }
            $this->request->setStatus($state);
            $this->entityManager->persist($this->request);
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @param $state
     * @return bool
     */
    private function hasPrivileges(User $user, $state)
    {
        $validator       = new RequestStateValidator($this->request);
        $availableStates = $validator->getAvailableStatesToChangeForUser($user);

        return in_array($state, $availableStates);
    }

}