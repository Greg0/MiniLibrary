<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 26.11.2016
 * Time: 22:41
 */

namespace Greg0\LibraryBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;

class Group extends BaseGroup
{
    protected $id;

    public function __toString()
    {
        return $this->getName();
    }
}