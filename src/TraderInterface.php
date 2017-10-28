<?php

namespace Xoptov\TradingBot;

use Xoptov\TradingBot\Model\Active;
use Xoptov\TradingBot\Model\Order;
use Xoptov\TradingBot\Chart\Chart;

interface TraderInterface
{
    /**
     * @return array
     */
    public function getAsks();

    /**
     * @return array
     */
    public function getBids();

    /**
     * @return Active[]
     */
    public function getActives();

    /**
     * @return Order[]
     */
    public function getOrders();

    /**
     * @return Chart
     */
    public function getChart();
}