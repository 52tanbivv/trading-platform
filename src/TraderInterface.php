<?php

namespace Xoptov\TradingBot;

use Xoptov\TradingBot\Model\Active;
use Xoptov\TradingBot\Chart\Chart;

interface TraderInterface
{
    /**
     * @return array
     */
    public function getAskOrders();

    /**
     * @return array
     */
    public function getBidOrders();

    /**
     * @return Active[]
     */
    public function getActives();

    /**
     * @return Chart
     */
    public function getChart();
}