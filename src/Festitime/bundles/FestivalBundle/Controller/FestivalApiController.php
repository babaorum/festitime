<?php

namespace Festitime\bundles\FestivalBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Festitime\bundles\FestivalBundle\Document\Festival;

class FestivalApiController extends FOSRestController
{
    public function getFestivalAction($id)
    {
        $festivalService = $this->get('festitime.festival_service');
        $festival = $festivalService->getFestival($id);

        if($festival instanceof Festival)
        {
            return $this->view($festival, 200);
        }

        return $this->view(null, 204);
    }

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
