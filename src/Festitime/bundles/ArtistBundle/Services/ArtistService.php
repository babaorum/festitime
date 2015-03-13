<?php

namespace Festitime\bundles\ArtistBundle\Services;

use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ODM\MongoDB\DocumentManager;

class ArtistService
{
    /**
     * @var RequestStack
     */
    public $request;

    /**
     * @var DocumentManager
     */
    public $mongoManager;

    /**
     * @param RequestStack    $requestStack
     * @param DocumentManager $doctrineMongodb
     */
    public function __construct(RequestStack $requestStack, DocumentManager $doctrineMongodb)
    {
        $this->request = $requestStack;
        $this->mongoManager = $doctrineMongodb->getManager();
    }

    public function postArtist()
    {

    }

    public function getArtist($id)
    {
        $artist = $this->mongoManager->find('FestitimeDatabaseBundle:Artist', $id);
        return $artist;
    }

    public function getArtists()
    {
        $R_artist = $this->mongoManager->getRepository('FestitimeDatabaseBundle:Artist');
        $artists = $R_artist->findAll();
        return $artists;
    }

    public function putArtist($id)
    {

    }

    public function deleteArtist($id)
    {
        $R_artist = $this->mongoManager->getRepository('FestitimeDatabaseBundle:Artist');
        $artist = $R_artist->find($id);
        if(!is_null($artist))
        {
            $this->mongoManager->remove($artist);
            $this->mongoManager->flush();
        }
    }
}
