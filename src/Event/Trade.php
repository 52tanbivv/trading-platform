<?php

namespace Xoptov\TradingBot\Event;

class Trade
{
    /** @var string */
    private $id;

    /** @var string */
    private $type;

    /** @var float */
    private $rate;

    /** @var float */
    private $volume;

    /** @var \DateTime */
    private $date;

    /** @var float */
    private $total;

    /**
     * Trade constructor.
     * @param string $id
     * @param string $type
     * @param float $rate
     * @param float $volume
     * @param \DateTime $date
     * @param float $total
     */
    public function __construct($id, $type, $rate, $volume, \DateTime $date, $total)
    {
        $this->id = $id;
        $this->type = $type;
        $this->rate = $rate;
        $this->volume = $volume;
        $this->date = $date;
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * @return \DateTime
     */
    public function getDate()
    {
        $date = clone $this->date;

        return $date;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }
}