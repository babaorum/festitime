<?php

namespace Festitime\bundles\UserBundle\Services;

use Festitime\bundles\UserBundle\Document\User;

class UserService
{
    protected $request;
    protected $mongoManager;

    public function __construct($request, $doctrineMongodb)
    {
        $this->request = $request;
        $this->mongoManager = $doctrineMongodb->getManager();
    }

    public function postUser()
    {
        $request = $this->request->getCurrentRequest();
        $query = $request->request->all();
        if (!empty($query['submit']))
        {
            $user = new User();
            if(!empty($query['user']['pseudo']) && !empty($query['user']['password']))
            {
                $user->setPseudo($query['user']['pseudo']);
                $user->setPassword($query['user']['password']);

                $this->mongoManager->persist($user);
                $this->mongoManager->flush();
                
                return $user;
            }
        }
        return null;
    }

    /*public function getUsers()
    {
        $R_user = $this->mongoManager->getRepository('FestitimeUserBundle:User');
        $users = $R_user->findAll();
        return $users;
    }*/
}
