<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 27.11.2016
 * Time: 13:07
 */

namespace Greg0\LibraryBundle\Controller;


use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class UserAdminController extends BaseAdminController
{
    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function prePersistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function preUpdateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }
}