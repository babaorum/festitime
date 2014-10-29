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
				$this->mongoManager->persist($festival);
    			$this->mongoManager->flush();
				
				return $festival;
			}
		}
		return null;
	}

	public function getFestivals()
	{
		$R_festival = $this->mongoManager->getRepository('FestitimeFestivalBundle:Festival');
		$festivals = $R_festival->findAll();
		return $festivals;
	}
}
