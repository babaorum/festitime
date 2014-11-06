<?php

namespace Festitime\Listeners;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthentificationListener
{
    protected $router;
    protected $session;

    public function __construct($router, $loginRoute, $registerRoute)
    {
        $this->router = $router;
        $this->loginRoute = $loginRoute;
        $this->registerRoute = $registerRoute;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $currentRoute = $request->attributes->get('_route');

        $session = $request->getSession();
        $user_id = $session->get('user_id');

        if ((empty($user_id) || !isset($user_id)) && $currentRoute != $this->loginRoute && $currentRoute != $this->registerRoute)
        {
            $event->setResponse($this->redirectOnLoginPage());
        }
    }

    public function redirectOnLoginPage()
    {
       return new RedirectResponse($this->router->generate($this->loginRoute), 302);
    }
}
