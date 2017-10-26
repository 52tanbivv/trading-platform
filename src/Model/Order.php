<?php

namespace Xoptov\TradingBot\Model;

class Order
{
    const TYPE_BID = "bid";
    const TYPE_ASK = "ask";

    /** @var string */
    private $type;

    /** @var Active */
    private $active;

    /** @var Currency */
    private $currency;

    /** @var float */
    private $rate;

    /** @var float */
    private $volume;

    /** @var float */
    private $total;

    const STATUS_NEW = "new";
    const STATUS_PLACE = "placed";
    const STATUS_CANCELED = "canceled";
    const STATUS_DONE = "done";

    /** @var string */
    private $status = self::STATUS_NEW;

    /** @var \DateTime */
    private $createdAt;

    /** @var \DateTime */
    private $updatedAt;

    /**
     * Order constructor.
     * @param string $type
     * @param Active $active
     * @param Currency $currency
     * @param float $rate
     * @param float $volume
     * @param float $total
     * @param \DateTime $createdAt
     */
    public function __construct($type, Active $active, Currency $currency, $rate, $volume, $total, \DateTime $createdAt)
    {
        $this->type = $type;
        $this->active = $active;
        $this->currency = $currency;
        $this->rate = $rate;
        $this->volume = $volume;
        $this->total = $total;
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return Active
     */
    public function getActive()
    {
        $active = clone $this->active;

        return $active;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        $currency = clone $this->currency;

        return $currency;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @return float
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param string $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        $createdAt = clone $this->createdAt;

        return $createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Order
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        $updatedAt = clone $this->updatedAt;

        return $updatedAt;
    }
}