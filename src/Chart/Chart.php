<?php

namespace Xoptov\TradingBot\Chart;

class Chart
{
    /** @var \DatePeriod */
    private $period;

    /** @var AbstractPeriod[] */
    private $periods = array();
}