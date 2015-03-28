<?php

namespace Festitime\bundles\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Festitime\DatabaseBundle\Document\User;

class UserController extends Controller
{
    public function loginAction()
    {
        $session = $this->container->get('session');
        $userService = $this->container->get('festitime.user_service');
        $query = $this->container->get('request_stack')->getCurrentRequest()->request->all();

        if (!empty($query['connect']['pseudo'])) {
            $response = $userService->connectUser();
            
            if ($response instanceof User) {
                $session->set('user_id', $response->getId());
                $session->set('user_pseudo', $response->getPseudo());
                
                return $this->redirect($this->generateUrl('index'));
            }
        }
        $this->get('session')->getFlashBag()->add('success', array('message' => 'Vous n\'etes pas connecté'));
        $formConnect = $userService->getConnectForm();
        $formRegister = $userService->getRegisterForm();
        return $this->render(
            'FestitimeUserBundle:User:index.html.twig',
            array(  'formConnect' => $formConnect->createView(),
                    'formRegister' => $formRegister->createView()
            )
        );
    }

    /**
     * @author Romain Grelet
     *
     * login with OAuth2
     * @param  string $provider
     */
    public function loginOauthAction($provider, Request $request)
    {
        $session = $this->container->get('session');
        $homeUrl = $this->generateUrl('home');

        if ($session->has('accessToken') && $session->has('user')) {
            return $this->redirect($homeUrl);
        }

        if ($provider == 'google') {
            $this->client = $this->get('google.oauth_provider')->getGoogleClient();
            $this->client->setScopes(array('email', 'profile'));
            $this->client->setApprovalPrompt('auto');
            $code = $request->query->get('code');
            if ($code) {
                $this->client->authenticate($code);
                if ($this->client->getAccessToken()) {
                    $userService = $this->container->get('festitime.user_service');
                    $this->client->setAccessToken($this->client->getAccessToken());

                    // get user infos
                    $this->oauth2 = $this->get('festitime.google_oauth_provider');
                    $userData = $this->oauth2->getUserInfos();

                    $user = $userService->getUserBy(array('email' => $userData['email']));

                    if (is_null($user)) {
                        $user = $userService->postUserFromOAuth($userData);
                    }

                    $session->set('accessToken', $this->client->getAccessToken());
                    $session->set('user', $user->toArray());
                    
                    return $this->redirect($homeUrl);
                }
            }
        }
        
        return $this->redirect($homeUrl);
    }
    
    /**
     * @author Romain Grelet
     * logout action
     */
    public function logoutAction()
    {
        $session = $this->container->get('session');
        if ($session->has('user_id')) {
            $session->invalidate();
            return $this->redirect($this->generateUrl('login'));
        }
        if ($session->has('user')) {
            $session->invalidate();
            return $this->redirect($this->generateUrl('home'));
        }
    }

    public function postUserAction()
    {
        $userService = $this->container->get('festitime.user_service');
        $response = $userService->postUser();

        if ($response instanceof User) {
            $this->get('session')->getFlashBag()->add('success', array('message' => 'Votre compte a bien été créé'));
        } else {
            $this->get('session')->getFlashBag()->add('error', array('message' => 'Le formulaire comporte des erreurs'));
        }

        return $this->forward('FestitimeUserBundle:User:login');
    }
}
