<?php

namespace Festitime\bundles\UserBundle\Document;

class User
{
	protected $pseudo;

	protected $password;
    /**
     * @var MongoId $id
     */
    protected $id;


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
}