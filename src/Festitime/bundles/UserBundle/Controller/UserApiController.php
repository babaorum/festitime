<?php

namespace Festitime\bundles\UserBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Festitime\bundles\UserBundle\Document\User;

class UserApiController extends FOSRestController
{
    public function getUsersAction()
    {
        $userService = $this->container->get('festitime.user_service');        
        $users = $userService->getUsers();

        return $this->view($users, 200);
    }
}
