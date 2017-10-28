<?php

namespace Xoptov\TradingPlatform\Model;

class Rate
{
    use RateTrait;

    /**
     * Rate constructor.
     * @param float $price
     * @param float $volume
     */
    public function __construct($price, $volume)
    {
        $this->price = $price;
        $this->volume = $volume;
    }
}