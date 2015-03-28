<?php

namespace Festitime\bundles\ArtistBundle\Services;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Form\FormFactory;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\ODM\MongoDB\DocumentManager;
use Festitime\DatabaseBundle\Document\Artist;
use Festitime\bundles\ArtistBundle\Form\Type\ArtistType;
use Festitime\bundles\UserBundle\Services\FormService;

class ArtistService
{
    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var DocumentManager
     */
    protected $mongoManager;

    /**
     * @var FormFactory
     */
    protected $formBuilder;

    /**
     * @var ArtistType
     */
    protected $formArtist;

    /**
     * @var FormService
     */
    protected $formTool;

    /**
     * @param RequestStack    $requestStack
     * @param DocumentManager $doctrineMongodb
     * @param FormFactory     $formBuilder
     * @param ArtistType      $formArtist
     * @param FormService     $formTool
     */
    public function __construct(RequestStack $requestStack, ManagerRegistry $doctrineMongodb, FormFactory $formBuilder, ArtistType $formArtist, $formTool)
    {
        $this->requestStack = $requestStack;
        $this->mongoManager = $doctrineMongodb->getManager();
        $this->formBuilder  = $formBuilder;
        $this->formArtist   = $formArtist;
        $this->formTool     = $formTool;
    }

    public function postArtist()
    {
        $request = $this->requestStack->getCurrentRequest();

        $artist = new Artist();
        $form = $this->getArtistForm($artist);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->mongoManager->persist($artist);
            $this->mongoManager->flush();

            return $artist;
        }

        return $form;
    }

    public function getArtistForm(Artist  $artist)
    {
        $form = $this->formBuilder->create($this->formArtist, $artist);
        return $form;
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
        $request = $this->requestStack->getCurrentRequest();

        $artist = $this->getArtist($id);
        $form = $this->getArtistForm($artist);
        $form->handleRequest($request);
        //@todo Update is not working
        if ($form->isValid()) {
            $this->mongoManager->persist($artist);
            $this->mongoManager->flush();

            return $artist;
        }
        return $this->formTool->getAllFormErrors($form);
    }

    public function deleteArtist($id)
    {
        $R_artist = $this->mongoManager->getRepository('FestitimeDatabaseBundle:Artist');
        $artist = $R_artist->find($id);
        if (!is_null($artist)) {
            $this->mongoManager->remove($artist);
            $this->mongoManager->flush();
        }
    }
}
