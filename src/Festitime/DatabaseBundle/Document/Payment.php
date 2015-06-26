<?php

namespace Festitime\DatabaseBundle\Document;

use Festitime\DatabaseBundle\Traits\SerializerTrait;

class Payment
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
     * @var string $number
     */
    protected $number;

    /**
     * @var string $description
     */
    protected $description;

    /**
     * @var string $clientEmail
     */
    protected $clientEmail;

    /**
     * @var string $clientId
     */
    protected $clientId;

    /**
     * @var int $totalAmount
     */
    protected $totalAmount;

    /**
     * @var string $currencyCode
     */
    protected $currencyCode;

    /**
     * @var int $currencyDigitsAfterDecimalPoint
     */
    protected $currencyDigitsAfterDecimalPoint;


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
     * Set number
     *
     * @param string $number
     * @return self
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     *
     * @return string $number
     */
    public function getNumber()
    {
        return $this->number;
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
     * Set clientEmail
     *
     * @param string $clientEmail
     * @return self
     */
    public function setClientEmail($clientEmail)
    {
        $this->clientEmail = $clientEmail;
        return $this;
    }

    /**
     * Get clientEmail
     *
     * @return string $clientEmail
     */
    public function getClientEmail()
    {
        return $this->clientEmail;
    }

    /**
     * Set clientId
     *
     * @param string $clientId
     * @return self
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * Get clientId
     *
     * @return string $clientId
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set totalAmount
     *
     * @param int $totalAmount
     * @return self
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return int $totalAmount
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set currencyCode
     *
     * @param string $currencyCode
     * @return self
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    /**
     * Get currencyCode
     *
     * @return string $currencyCode
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Set currencyDigitsAfterDecimalPoint
     *
     * @param int $currencyDigitsAfterDecimalPoint
     * @return self
     */
    public function setCurrencyDigitsAfterDecimalPoint($currencyDigitsAfterDecimalPoint)
    {
        $this->currencyDigitsAfterDecimalPoint = $currencyDigitsAfterDecimalPoint;
        return $this;
    }

    /**
     * Get currencyDigitsAfterDecimalPoint
     *
     * @return int $currencyDigitsAfterDecimalPoint
     */
    public function getCurrencyDigitsAfterDecimalPoint()
    {
        return $this->currencyDigitsAfterDecimalPoint;
    }
}
