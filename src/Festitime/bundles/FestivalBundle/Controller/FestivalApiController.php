<?php

namespace Festitime\bundles\FestivalBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Festitime\bundles\FestivalBundle\Document\Festival;

class FestivalApiController extends FOSRestController
{
    public function getFestivalsAction()
    {
        $festivalService = $this->container->get('festitime.festival_service');
        $festivals = $festivalService->getFestivals();
        
        return $this->view($festivals, 200);
    }

    public function deleteFestivalAction($id)
    {
        $festivalService = $this->container->get('festitime.festival_service');
        $response = $festivalService->deleteFestival($id);
        
        return $this->view(null, 204);
    }
}
