<?php

namespace Festitime\DatabaseBundle\Document;

use Festitime\DatabaseBundle\Traits\SerializerTrait;

/**
 * Festitime\bundles\UserBundle\Document\Artist
 */
class Artist
{
    /**
     * Use SerializerTrait to have access 
     * to generic methods toArray() & toJSON()
     */
    use SerializerTrait;

    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var Festitime\DatabaseBundle\Document\Festival
     */
    protected $festival;

    /**
     * @var Festitime\DatabaseBundle\Document\Artist
     */
    protected $artist;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set festival
     *
     * @param Festitime\DatabaseBundle\Document\Festival $festival
     * @return self
     */
    public function setFestival(\Festitime\DatabaseBundle\Document\Festival $festival)
    {
        $this->festival = $festival;
        return $this;
    }

    /**
     * Get festival
     *
     * @return Festitime\DatabaseBundle\Document\Festival $festival
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Set artist
     *
     * @param Festitime\DatabaseBundle\Document\Artist $artist
     * @return self
     */
    public function setArtist(\Festitime\DatabaseBundle\Document\Artist $artist)
    {
        $this->artist = $artist;
        return $this;
    }

    /**
     * Get artist
     *
     * @return Festitime\DatabaseBundle\Document\Artist $artist
     */
    public function getArtist()
    {
        return $this->artist;
    }
}
