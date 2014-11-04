<?php

namespace Festitime\bundles\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Festitime\bundles\UserBundle\Document\User;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('FestitimeUserBundle:User:index.html.twig', array());
    }

    public function postUserAction()
    {
        $userService = $this->container->get('festitime.user_service');
        $response = $userService->postUser();
        
        if ($response instanceof User)
        {
            //$this->get('session')->getFlashBag()->add('success', 'L\'utilisateur a bien été créé');
            die(var_dump($response));
        }
        else
        {
            $this->get('session')->getFlashBag()->add('error', 'Le pseudo et le mot de passe de l\'utilisateur doivent être remplis');
        }
        return $this->redirect($this->generateUrl('index'));
    }

    /*public function getUsersAction()
    {
        $response = array();
        $userService = $this->container->get('festitime.user_service');
        $users = $userService->getUsers();
        
        foreach($users as $user)
        {
            if ($user instanceof User)
            {
                $response[] = $user->toArray();
            }
        }
        $serializer = $this->get('jms_serializer');
        $response = new Response($serializer->serialize($response, "json"));
        return $response;
    }*/
}
