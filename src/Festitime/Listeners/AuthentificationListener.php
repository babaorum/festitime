<?php

namespace Festitime\Listeners;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthentificationListener
{
    protected $router;
    protected $loginRoute;
    protected $connectedRoute;
    protected $twig;
    protected $googleClient;

    public function __construct($router, $loginRoute, $connectedRoute, $twig, $googleOAuthProvider)
    {
        $this->router = $router;
        $this->loginRoute = $loginRoute;
        $this->connectedRoute = $connectedRoute;
        $this->googleClient = $googleOAuthProvider->getGoogleClient();
        $this->twig = $twig;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $redirect = false;
        $request = $event->getRequest();
        $currentRoute = $request->attributes->get('_route');

        $session = $request->getSession();
        $user_id = $session->get('user_id');
        
        if (empty($user_id)) {
            $this->googleClient->setScopes(array('email', 'profile'));
            $this->googleClient->setApprovalPrompt('auto');
            $googleAuthUrl = $this->googleClient->createAuthUrl();
            $this->twig->addGlobal('googleAuthUrl', $googleAuthUrl);

            foreach ($this->connectedRoute as $route) {
                if ($currentRoute === $route) {
                    $redirect = true;
                    break;
                }
            }
            if ($redirect) {
                $event->setResponse($this->redirectOnLoginPage());
            }
        }
    }

    public function redirectOnLoginPage()
    {
        return new RedirectResponse($this->router->generate($this->loginRoute), 302);
    }
}
