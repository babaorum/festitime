<?php

namespace Festitime\bundles\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Festitime\bundles\UserBundle\Document\User;

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
        $formRegister = $userService->getRegisterForm();
        return $this->render('FestitimeUserBundle:User:index.html.twig', 
            array(  'formConnect' => $formConnect->createView(), 
                    'formRegister' => $formRegister->createView() 
            )
        );
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
            $this->get('session')->getFlashBag()->add('success', array('message' => 'Votre compte a bien été créé'));
        }
        else
        {
            $this->get('session')->getFlashBag()->add('error', array('message' => 'Le formulaire comporte des erreurs'));
        }

        return $this->forward('FestitimeUserBundle:User:login');
    }
}
