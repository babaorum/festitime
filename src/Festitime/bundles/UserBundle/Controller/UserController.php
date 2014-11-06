<?php

namespace Festitime\bundles\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Festitime\bundles\UserBundle\Document\User;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function loginAction()
    {
        $session = $this->container->get('session');
        $userService = $this->container->get('festitime.user_service');
        $query = $this->container->get('request_stack')->getCurrentRequest()->request->all();

        if(!empty($query['connect']['pseudo']))
        {
            $response = $userService->connectUser();
            
            if($response instanceof User)
            {
                $session->set('user_id', $response->getId());
                $session->set('user_pseudo', $response->getPseudo());
                
                return $this->redirect($this->generateUrl('index'));
            }
        }
$this->get('session')->getFlashBag()->add('success', array('message' => 'Vous n\'etes pas connecté'));
        $formConnect = $userService->getConnectForm();
        return $this->render('FestitimeUserBundle:User:index.html.twig', array('formConnect' => $formConnect->createView()));
    }
    
    /**
    *   @author Romain Grelet
    *   logout action
    */
    public function logoutAction()
    {
        $session = $this->container->get('session');
        if ($session->has('user_id'))
        {
            $session->invalidate();
            return $this->redirect($this->generateUrl('login'));
        }
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

    public function getUsersAction()
    {
        $serializer = $this->get('jms_serializer');
        $userService = $this->container->get('festitime.user_service');
        
        $users = $userService->getUsers();
        $response = new Response($serializer->serialize($users, "json"));
        
        return $response;
    }
}
