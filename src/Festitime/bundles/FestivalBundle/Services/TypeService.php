<?php

namespace Festitime\bundles\FestivalBundle\Services;

use Festitime\DatabaseBundle\Document\Type;

class TypeService
{
    protected $request;
    protected $mongoManager;

    public function __construct($request, $doctrineMongodb)
    {
        $this->request = $request;
        $this->mongoManager = $doctrineMongodb->getManager();
    }

    public function getType($id)
    {
        $type = $this->mongoManager->find('FestitimeDatabaseBundle:Type', $id);
        return $type;
    }

    /**
     * @param  array|null $params
     * @return array
     */
    public function getTypes(array $params = null)
    {
        $repository = $this->mongoManager->getRepository('FestitimeDatabaseBundle:Type');
        if (!empty($params['limit'])) {
            $types = array_values($repository->getTypes($params['limit']));
        } else {
            $types = $repository->findAll();
        }

        return $types;
    }

    public function deleteType($id)
    {
        $typeRepository = $this->mongoManager->getRepository('FestitimeDatabaseBundle:Type');
        $type = $typeRepository->find($id);
        if (!is_null($type)) {
            $this->mongoManager->remove($type);
            $this->mongoManager->flush();
        }
    }
}
