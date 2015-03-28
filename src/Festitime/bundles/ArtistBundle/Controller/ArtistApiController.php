<?php

namespace Festitime\bundles\ArtistBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Festitime\DatabaseBundle\Document\Artist;

class ArtistApiController extends FOSRestController
{
    public function getArtistAction($id)
    {
        $artistService = $this->get('festitime.artist_service');
        $artist = $artistService->getArtist($id);

        if ($artist instanceof Artist) {
            return $this->view($artist, 200);
        }

        return $this->view(null, 204);
    }

    public function getArtistsAction()
    {
        $artistService = $this->container->get('festitime.artist_service');
        $artists = $artistService->getArtists();

        return $this->view($artists, 200);
    }

    public function postArtistAction()
    {
        $artistService = $this->container->get('festitime.artist_service');
        $artist = $artistService->postArtist();

        return $artist;
    }

    public function putArtistAction($id)
    {
        $artistService = $this->container->get('festitime.artist_service');
        $artist = $artistService->putArtist($id);
        return $artist;
    }

    public function deleteArtistAction($id)
    {
        $artistService = $this->container->get('festitime.artist_service');
        $artistService->deleteArtist($id);

        return $this->view(null, 204);
    }
}
