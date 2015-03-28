<?php

namespace Festitime\bundles\UserBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Festitime\DatabaseBundle\Document\User;

class UserApiController extends FOSRestController
{
    public function getUserAction($id)
    {
        $userService = $this->container->get('festitime.user_service');
        $user = $userService->getUser($id);
        
        if ($user instanceof User) {
            return $this->view($user, 200);
        }
        return $this->view(null, 204);
    }

    public function getUsersAction()
    {
        $userService = $this->container->get('festitime.user_service');
        $users = $userService->getUsers();

        return $this->view($users, 200);
    }
}
