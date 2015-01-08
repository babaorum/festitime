<?php

namespace Festitime\bundles\FestivalBundle\Services;

use Festitime\bundles\FestivalBundle\Document\Festival;

class FestivalService
{
    protected $request;
    protected $mongoManager;

    public function __construct($request, $doctrineMongodb)
    {
        $this->request = $request;
        $this->mongoManager = $doctrineMongodb->getManager();
    }

    public function postFestival()
    {
        $request = $this->request->getCurrentRequest();
        $query = $request->request->all();
        if (!empty($query['submit']))
        {
            $festival = new Festival();
            if(!empty($query['festival']['name']))
            {
                $festival->setName($query['festival']['name']);
                
                if(!empty($query['festival']['description']))
                {
                    $festival->setDescription($query['festival']['description']);
                }
                if(!empty($query['festival']['types']))
                {
                    $festival->setType($query['festival']['types']);
                }
                if(!empty($query['festival']['img']))
                {
                    $festival->setImg($query['festival']['img']);
                }
                if(!empty($query['festival']['start_date']))
                {
                    $festival->setStartDate($query['festival']['start_date']);
                }
                if(!empty($query['festival']['end_date']))
                {
                    $festival->setEndDate($query['festival']['end_date']);
                }
                if(!empty($query['festival']['city']))
                {
                    $festival->setCity($query['festival']['city']);
                }
                if(!empty($query['festival']['region']))
                {
                    $festival->setRegion($query['festival']['region']);
                }
                if(!empty($query['festival']['country']))
                {
                    $festival->setCountry($query['festival']['country']);
                }
                if(!empty($query['festival']['price']))
                {
                    $festival->setPrice($query['festival']['price']);
                }
                $this->mongoManager->persist($festival);
                $this->mongoManager->flush();
                
                return $festival;
            }
        }
        return null;
    }

    public function getFestival($id)
    {
        $festival = $this->mongoManager->find('FestitimeFestivalBundle:Festival', $id);
        return $festival;
    }

    public function getFestivals()
    {
        $R_festival = $this->mongoManager->getRepository('FestitimeFestivalBundle:Festival');
        $festivals = $R_festival->findAll();
        return $festivals;
    }

    public function putFestival($id)
    {
        $R_festival = $this->mongoManager->getRepository('FestitimeFestivalBundle:Festival');
        $festival = $R_festival->find($id);
        $festival->setImg('http://www.concertandco.com/crit2/Trans-Musicales-2007web.jpg');
        $this->mongoManager->persist($festival);
        $this->mongoManager->flush();
    }

    public function deleteFestival($id)
    {
        $R_festival = $this->mongoManager->getRepository('FestitimeFestivalBundle:Festival');
        $festival = $R_festival->find($id);
        if(!is_null($festival))
        {
            $this->mongoManager->remove($festival);
            $this->mongoManager->flush();
        }
    }
}
