<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 21.01.2017
 * Time: 15:21
 */

namespace Greg0\LibraryBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Greg0\LibraryBundle\Entity\Book;
use Greg0\LibraryBundle\Entity\User;

class BookRepository extends EntityRepository
{
    public function findForUser(User $user)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $query   = $builder->select(['b'])
            ->from('LibraryBundle:Book', 'b')
            ->join('b.user', 'u', 'WITH', $builder->expr()->eq('u.id', $user->getId()))
            ->orderBy('b.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    public function findAllOrderedByTitle()
    {
        return $this->findBy([], ['title' => 'ASC']);
    }


    /**
     * @param $keyword
     * @return Book[]
     */
    public function findAllSearch($keyword)
    {
        if (empty($keyword))
        {
            return [];
        }

        $builder = $this->createQueryBuilder('b');

        $query = $builder
            ->select('b')
            ->where('b.title LIKE :title')
            ->setParameter('title', '%'.$keyword.'%')
            ->getQuery();

        return $query->getResult();
    }

}