<?php

namespace Festitime\bundles\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FestitimeUserBundle:User:index.html.twig', array());
    }
}
