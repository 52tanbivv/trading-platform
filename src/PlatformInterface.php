<?php

namespace Xoptov\TradingPlatform;

use Xoptov\TradingPlatform\Trader\TraderInterface;
use Xoptov\TradingPlatform\Model\CurrencyPair;
use Xoptov\TradingPlatform\Model\Currency;
use Xoptov\TradingPlatform\Chart\Chart;
use Xoptov\TradingPlatform\Model\Rate;

interface PlatformInterface
{
    /**
     * @return boolean
     */
    public function start();

    /**
     * @param TraderInterface $trader
     * @return boolean
     */
    public function attach(TraderInterface $trader);

    /**
     * @return Currency[]
     */
    public function getCurrencies();

    /**
     * @return CurrencyPair[]
     */
    public function getCurrencyPairs();

    /**
     * @return Chart
     */
    public function getChart();

    /**
     * @return Rate[]
     */
    public function getAsks();

    /**
     * @return Rate[]
     */
    public function getBids();
}