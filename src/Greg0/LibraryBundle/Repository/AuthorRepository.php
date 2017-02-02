<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 21.01.2017
 * Time: 15:21
 */

namespace Greg0\LibraryBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Greg0\LibraryBundle\Entity\Author;

class AuthorRepository extends EntityRepository
{
    /**
     * @param $keyword
     * @return Author[]
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
            ->where('b.firstName LIKE :title')
            ->orWhere('b.lastName LIKE :title')
            ->setParameter('title', '%'.$keyword.'%')
            ->getQuery();

        return $query->getResult();
    }

}