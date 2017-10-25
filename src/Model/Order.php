<?php

namespace Xoptov\TradingBot\Model;

class Order
{
    const TYPE_BID = "bid";
    const TYPE_ASK = "ask";

    /** @var string */
    private $type;

    /** @var CurrencyPair */
    private $currencyPair;

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
     * @param CurrencyPair $currencyPair
     * @param float $rate
     * @param float $volume
     * @param float $total
     * @param \DateTime $createdAt
     */
    public function __construct($type, CurrencyPair $currencyPair, $rate, $volume, $total, \DateTime $createdAt)
    {
        $this->type = $type;
        $this->currencyPair = $currencyPair;
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
     * @return CurrencyPair
     */
    public function getCurrencyPair()
    {
        $currencyPair = clone $this->currencyPair;

        return $currencyPair;
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