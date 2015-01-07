<?php

namespace Festitime\bundles\FestivalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Festitime\bundles\FestivalBundle\Document\Festival;
use Symfony\Component\HttpFoundation\Response;

class FestivalController extends Controller
{
    public function indexAction()
    {
        return $this->render('FestitimeFestivalBundle:Festival:index.html.twig', array());
    }

    public function homeAction()
    {
        return $this->render('FestitimeFestivalBundle:Festival:home.html.twig', array());
    }
    public function putFestivalAction($id)
    {
        $festivalService = $this->container->get('festitime.festival_service');
        $festivalService->putFestival($id);
        die('ok');
    }

    public function postFestivalAction()
    {
        $festivalService = $this->container->get('festitime.festival_service');
        $response = $festivalService->postFestival();
        
        if ($response instanceof Festival)
        {
            $this->get('session')->getFlashBag()->add('success', 'Le festival a bien été créé');
        }
        else
        {
            $this->get('session')->getFlashBag()->add('error', 'Le nom du festival festival doit être rempli');
        }
        return $this->redirect($this->generateUrl('index'));
    }

    public function getFestivalsAction()
    {
        $response = array();
        $festivalService = $this->container->get('festitime.festival_service');
        $festivals = $festivalService->getFestivals();
        
        foreach($festivals as $festival)
        {
            if ($festival instanceof Festival)
            {
                $response[] = $festival->toArray();
            }
        }
        $serializer = $this->get('jms_serializer');
        $response = new Response($serializer->serialize($response, "json"));
        return $response;
    }

    public function deleteFestivalAction($id)
    {
        $festivalService = $this->container->get('festitime.festival_service');
        $response = $festivalService->deleteFestival($id);
        return new Response('', "json");
    }
}
