<?php

namespace Xoptov\TradingBot\Chart;

class Period
{
    /** @var \DatePeriod */
    private $period;

    /** @var float */
    private $open;

    /** @var float */
    private $close;

    /** @var float */
    private $high;

    /** @var float */
    private $low;

    /**
     * Period constructor.
     * @param \DatePeriod $period
     * @param float $open
     * @param float $close
     * @param float $high
     * @param float $low
     */
    public function __construct(\DatePeriod $period, $open, $close, $high, $low)
    {
        $this->period = $period;
        $this->open = $open;
        $this->close = $close;
        $this->high = $high;
        $this->low = $low;
    }

    /**
     * @return \DatePeriod
     */
    public function getPeriod()
    {
        $period = clone $this->period;

        return $period;
    }

    /**
     * @return float
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * @return float
     */
    public function getClose()
    {
        return $this->close;
    }

    /**
     * @return float
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * @return float
     */
    public function getLow()
    {
        return $this->low;
    }
}