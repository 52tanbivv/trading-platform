<?php

namespace Xoptov\TradingBot\Event;

class Book
{
    /** @var string */
    private $type;

    /** @var float */
    private $rate;

    /** @var float */
    private $volume;

    /** @var float */
    private $total;

    /**
     * Book constructor.
     * @param string $type
     * @param float $rate
     * @param float $volume
     * @param float $total
     */
    public function __construct($type, $rate, $volume, $total)
    {
        $this->type = $type;
        $this->rate = $rate;
        $this->volume = $volume;
        $this->total = $total;
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
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }
}