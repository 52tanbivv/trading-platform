<?php

namespace Xoptov\TradingPlatform\Message;

class OrderBook implements MessageInterface
{
    /** @var string */
    private $type;

    /** @var float */
    private $rate;

    /** @var float */
    private $volume;

    /** @var float */
    private $total;

    const ACTION_MODIFY = "modify";
    const ACTION_REMOVE = "remove";

    /** @var string */
    private $action;

    /**
     * Book constructor.
     * @param string $type
     * @param float $rate
     * @param float $volume
     * @param float $total
     * @param string $action
     */
    public function __construct($type, $rate, $volume, $total, $action)
    {
        $this->type = $type;
        $this->rate = $rate;
        $this->volume = $volume;
        $this->total = $total;
        $this->action = $action;
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

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
}