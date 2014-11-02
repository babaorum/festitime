<?php

namespace Festitime\bundles\ConnectionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FestitimeConnectionBundle:Default:index.html.twig', array('name' => $name));
    }
}
