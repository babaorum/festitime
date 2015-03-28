<?php

namespace Festitime\DatabaseBundle\Document;

use Festitime\DatabaseBundle\Traits\SerializerTrait;

/**
 * Festitime\bundles\UserBundle\Document\User
 */
class User
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
     * @var string $email
     */
    protected $email;

    /**
     * @var string $password
     */
    protected $password;

    /**
     * @var date $birthdate
     */
    protected $birthdate;

    /**
     * @var boolean $gender
     */
    protected $gender;

    /**
     * @var string $firstname
     */
    protected $firstname;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $address
     */
    protected $address;

    /**
     * @var string $city
     */
    protected $city;

    /**
     * @var string $zipcode
     */
    protected $zipcode;

    /**
     * @var string $country
     */
    protected $country;

    /**
     * @var string $picture
     */
    protected $picture;

    /**
     * @var date $created_at
     */
    protected $created_at;

    /**
     * @var date $updated_at
     */
    protected $updated_at;


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
     * Set email
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set birthdate
     *
     * @param date $birthdate
     * @return self
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * Get birthdate
     *
     * @return date $birthdate
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     * @return self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean $gender
     */
    public function getGender()
    {
        return $this->gender;
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
     * Set address
     *
     * @param string $address
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
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
     * Set zipcode
     *
     * @param string $zipcode
     * @return self
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string $zipcode
     */
    public function getZipcode()
    {
        return $this->zipcode;
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
     * Set createdAt
     *
     * @param date $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param date $updatedAt
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return date $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
