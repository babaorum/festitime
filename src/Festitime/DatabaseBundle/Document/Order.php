<?php

namespace Festitime\DatabaseBundle\Document;



/**
 * Festitime\DatabaseBundle\Document\Order
 */
class Order
{
    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var string $paypalPaymentId
     */
    protected $paypalPaymentId;

    /**
     * @var int $price
     */
    protected $price;

    /**
     * @var string $state
     */
    protected $state;


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
     * Set paypalPaymentId
     *
     * @param string $paypalPaymentId
     * @return self
     */
    public function setPaypalPaymentId($paypalPaymentId)
    {
        $this->paypalPaymentId = $paypalPaymentId;
        return $this;
    }

    /**
     * Get paypalPaymentId
     *
     * @return string $paypalPaymentId
     */
    public function getPaypalPaymentId()
    {
        return $this->paypalPaymentId;
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
     * Set state
     *
     * @param string $state
     * @return self
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get state
     *
     * @return string $state
     */
    public function getState()
    {
        return $this->state;
    }
}