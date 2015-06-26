<?php

namespace Festitime\bundles\FestivalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    public function searchAction()
    {
        return $this->render('FestitimeFestivalBundle:Festival:new-search.html.twig', array());
    }

    public function searchBySlugAction($slug)
    {
        return $this->render(
            'FestitimeFestivalBundle:Festival:search.html.twig',
            array(
                'searchedSlug' => utf8_encode(utf8_decode($slug))
            )
        );
    }

    public function searchByTypeAction($type)
    {
        return $this->render(
            'FestitimeFestivalBundle:Festival:search.html.twig',
            array(
                'searchedType' => $type
            )
        );
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

    public function festivalAction($id)
    {
        $festivalService = $this->container->get('festitime.festival_service');
        if (!empty($id)) {
            $festival = $festivalService->getFestival($id);
            if ($festival instanceof Festival) {
                return $this->render(
                    'FestitimeFestivalBundle:Festival:festival.html.twig',
                    array(
                        'festival' => $festival
                    )
                );
            }
        }
    }
}
