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
     * @var string $pseudo
     */
    protected $pseudo;

    /**
     * @var string $firstname
     */
    protected $firstname;

    /**
     * @var string $lastname
     */
    protected $lastname;

    /**
     * @var string $description
     */
    protected $description;

    /**
     * @var collection $type
     */
    protected $type;

    /**
     * @var string $picture
     */
    protected $picture;

    /**
     * @var collection $pictures
     */
    protected $pictures;

    /**
     * @var Festitime\DatabaseBundle\Document\FestivalArtists
     */
    protected $festival_artists = array();

    public function __construct()
    {
        $this->festival_artists = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set pseudo
     *
     * @param string $pseudo
     * @return self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string $pseudo
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string $lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param collection $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return collection $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return self
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * Get picture
     *
     * @return string $picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set pictures
     *
     * @param collection $pictures
     * @return self
     */
    public function setPictures($pictures)
    {
        $this->pictures = $pictures;
        return $this;
    }

    /**
     * Get pictures
     *
     * @return collection $pictures
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Add festivalArtist
     *
     * @param Festitime\DatabaseBundle\Document\FestivalArtists $festivalArtist
     */
    public function addFestivalArtist(\Festitime\DatabaseBundle\Document\FestivalArtists $festivalArtist)
    {
        $this->festival_artists[] = $festivalArtist;
    }

    /**
     * Remove festivalArtist
     *
     * @param Festitime\DatabaseBundle\Document\FestivalArtists $festivalArtist
     */
    public function removeFestivalArtist(\Festitime\DatabaseBundle\Document\FestivalArtists $festivalArtist)
    {
        $this->festival_artists->removeElement($festivalArtist);
    }

    /**
     * Get festivalArtists
     *
     * @return Doctrine\Common\Collections\Collection $festivalArtists
     */
    public function getFestivalArtists()
    {
        return $this->festival_artists;
    }
}
