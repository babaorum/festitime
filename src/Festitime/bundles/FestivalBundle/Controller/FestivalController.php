<?php

namespace Festitime\bundles\FestivalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Festitime\DatabaseBundle\Document\Festival;

class FestivalController extends Controller
{
    public function newHomeAction()
    {
        return $this->render('FestitimeFestivalBundle:Festival:home.html.twig', array());
    }

    public function indexAction()
    {
        return $this->render('FestitimeFestivalBundle:Festival:index.html.twig', array());
    }

    public function adminAction()
    {
        return $this->render('FestitimeFestivalBundle:Festival:admin.html.twig', array());
    }

    public function postFestivalAction()
    {
        $festivalService = $this->container->get('festitime.festival_service');
        $response = $festivalService->postFestival();

        if ($response instanceof Festival) {
            $this->get('session')->getFlashBag()->add('success', 'Le festival a bien été créé');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Le nom du festival festival doit être rempli');
        }
        return $this->redirect($this->generateUrl('home'));
    }
}
