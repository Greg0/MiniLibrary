<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 27.11.2016
 * Time: 13:07
 */

namespace Greg0\LibraryBundle\Controller;


use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class GroupAdminController extends BaseAdminController
{
    public function createNewGroupEntity()
    {
        return $this->get('fos_user.group_manager')->createGroup(null);
    }

    public function prePersistGroupEntity($group)
    {
        $this->get('fos_user.group_manager')->updateGroup($group, false);
    }

    public function preUpdateGroupEntity($group)
    {
        $this->get('fos_user.group_manager')->updateGroup($group, false);
    }
}