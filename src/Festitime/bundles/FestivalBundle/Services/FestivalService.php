<?php

namespace Festitime\bundles\FestivalBundle\Services;

use Festitime\DatabaseBundle\Document\Festival;
use Festitime\DatabaseBundle\Document\Artist;

class FestivalService
{
    protected $request;
    protected $mongoManager;
    protected $artistService;

    public function __construct($request, $doctrineMongodb, $artistService)
    {
        $this->request = $request;
        $this->mongoManager = $doctrineMongodb->getManager();
        $this->artistService = $artistService;
    }

    public function postFestival()
    {
        $request = $this->request->getCurrentRequest();
        $query = $request->request->all();
        if (!empty($query['submit'])) {
            $festival = new Festival();
            if (!empty($query['festival']['name'])) {
                $festival->setName($query['festival']['name']);

                if (!empty($query['festival']['description'])) {
                    $festival->setDescription($query['festival']['description']);
                }
                if (!empty($query['festival']['types'])) {
                    $festival->setType($query['festival']['types']);
                }
                if (!empty($query['festival']['img'])) {
                    $festival->setImg($query['festival']['img']);
                }
                if (!empty($query['festival']['start_date'])) {
                    $festival->setStartDate($query['festival']['start_date']);
                }
                if (!empty($query['festival']['end_date'])) {
                    $festival->setEndDate($query['festival']['end_date']);
                }
                if (!empty($query['festival']['city'])) {
                    $festival->setCity($query['festival']['city']);
                }
                if (!empty($query['festival']['region'])) {
                    $festival->setRegion($query['festival']['region']);
                }
                if (!empty($query['festival']['country'])) {
                    $festival->setCountry($query['festival']['country']);
                }
                if (!empty($query['festival']['price'])) {
                    $festival->setPrice($query['festival']['price']);
                }
                if (!empty($query['festival']['pictures'])) {
                    $festival->setPictures($query['festival']['pictures']);
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
        $festival = $this->mongoManager->find('FestitimeDatabaseBundle:Festival', $id);
        return $festival;
    }

    public function getFestivals()
    {
        $R_festival = $this->mongoManager->getRepository('FestitimeDatabaseBundle:Festival');
        $festivals = $R_festival->findAll();
        return $festivals;
    }

    public function getFestivalsRandomPictures($count)
    {
        if (!is_numeric($count)) {
            $count = intval($count);
        }
        $pictures = $this->getAllFestivalsPictures();
        if ($count > count($pictures)) {
            return $pictures;
        } else {
            $randomKeys = array_rand($pictures, $count);
            $randomPictures = array();
            foreach ($randomKeys as $key) {
                $randomPictures[$key] = $pictures[$key];
            }
            return $randomPictures;
        }
    }

    public function getAllFestivalsPictures()
    {
        $pictures = array();
        foreach ($this->getFestivals() as $festival) {
            if (!is_null($festival->getPictures())) {
                $pictures = array_merge($pictures, $festival->getPictures());
            }
        }
        return $pictures;
    }

    public function putFestival($id)
    {
        $R_festival = $this->mongoManager->getRepository('FestitimeDatabaseBundle:Festival');
        $festival = $R_festival->find($id);
        $festival->setPictures(array("http://www.laboiteamusiqueinde.com/wp-content/uploads/2013/03/saez5461.jpg",
"http://www.desinvolt.fr/wp-content/uploads/arton375.jpg",
"https://i1.ytimg.com/vi/WtFO6GCg8Xo/hqdefault.jpg"));
        $this->mongoManager->persist($festival);
        $this->mongoManager->flush();
        die(var_dump($festival));
    }

    public function deleteFestival($id)
    {
        $R_festival = $this->mongoManager->getRepository('FestitimeDatabaseBundle:Festival');
        $festival = $R_festival->find($id);
        if (!is_null($festival)) {
            $this->mongoManager->remove($festival);
            $this->mongoManager->flush();
        }
    }

    /**
     * Link all given artists to the festival referenced by $id
     *
     * @param  string $id
     * @param  array  $idArtists
     *
     * @return Festival|false
     */
    public function linkFestivalArtists($id, array $idArtists)
    {
        $festival = $this->getFestival($id);
        if ($festival instanceof Festival) {
            foreach ($idArtists as $idArtist) {
                $artist = $this->artistService->getArtist($idArtist);
                if ($artist instanceof Artist) {
                    $festival->addArtist($artist);
                    $artist->addFestival($festival);
                    $this->mongoManager->persist($artist);
                }
            }
            $this->mongoManager->persist($festival);
            $this->mongoManager->flush();
            return $festival;
        }

        return false;
    }
}
