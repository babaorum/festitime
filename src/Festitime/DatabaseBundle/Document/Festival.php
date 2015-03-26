<?php

namespace Festitime\DatabaseBundle\Document;

use Festitime\DatabaseBundle\Traits\SerializerTrait;

/**
 * Festitime\bundles\UserBundle\Document\Festival
 */
class Festival
{
    /**
     * Use SerializerTrait to have access
     * to generic methods toArray() & toJSON()
     */
    use SerializerTrait;

    public function __construct()
    {
        $this->artists = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var Festitime\DatabaseBundle\Document\Artist
     */
    protected $artists = array();

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $description
     */
    protected $description;

    /**
     * @var collection $type
     */
    protected $type;

    /**
     * @var string $img
     */
    protected $img;

    /**
     * @var date $start_date
     */
    protected $start_date;

    /**
     * @var date $end_date
     */
    protected $end_date;

    /**
     * @var string $city
     */
    protected $city;

    /**
     * @var string $region
     */
    protected $region;

    /**
     * @var string $country
     */
    protected $country;

    /**
     * @var int $price
     */
    protected $price;

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
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
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
     * Set img
     *
     * @param string $img
     * @return self
     */
    public function setImg($img)
    {
        $this->img = $img;
        return $this;
    }

    /**
     * Get img
     *
     * @return string $img
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set startDate
     *
     * @param date $startDate
     * @return self
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;
        return $this;
    }

    /**
     * Get startDate
     *
     * @return date $startDate
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set endDate
     *
     * @param date $endDate
     * @return self
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;
        return $this;
    }

    /**
     * Get endDate
     *
     * @return date $endDate
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return self
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * Get region
     *
     * @return string $region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return self
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set price
     *
     * @param int $price
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return int $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add artist
     *
     * @param Festitime\DatabaseBundle\Document\Artist $artist
     */
    public function addArtist(\Festitime\DatabaseBundle\Document\Artist $artist)
    {
        $this->artists[] = $artist;
    }

    /**
     * Remove artist
     *
     * @param Festitime\DatabaseBundle\Document\Artist $artist
     */
    public function removeArtist(\Festitime\DatabaseBundle\Document\Artist $artist)
    {
        $this->artists->removeElement($artist);
    }

    /**
     * Get artists
     *
     * @return Doctrine\Common\Collections\Collection $artists
     */
    public function getArtists()
    {
        return $this->artists;
    }
}
