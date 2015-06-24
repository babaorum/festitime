<?php

namespace Festitime\bundles\FestivalBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use Festitime\DatabaseBundle\Document\Type;

class TypeApiController extends FOSRestController
{
    public function getTypeAction($id)
    {
        $typeService = $this->get('festitime.type_service');
        $type = $typeService->getType($id);

        if ($type instanceof Type) {
            return $this->view($type, 200);
        }

        return $this->view(null, 204);
    }

    public function getTypesAction(Request $request)
    {
        $queryParams = $request->query->all();
        $typeService = $this->container->get('festitime.type_service');
        $types = $typeService->getTypes($queryParams);

        return $this->view($types, 200);
    }

    public function putTypeAction($id)
    {
        $typeService = $this->container->get('festitime.type_service');
        $typeService->putType($id);
        die('ok');
    }

    public function deleteFestivalAction($id)
    {
        $typeService = $this->container->get('festitime.type_service');
        $typeService->deleteType($id);

        return $this->view(null, 204);
    }
}
