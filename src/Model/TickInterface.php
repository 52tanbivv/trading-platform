<?php

namespace Xoptov\TradingBot\Model;

interface TickInterface
{
    /**
     * @return CurrencyPair
     */
    public function getCurrencyPair();

    /**
     * @return float
     */
    public function getLast();

    /**
     * @return float
     */
    public function getLowAsk();

    /**
     * @return float
     */
    public function getHighBid();

    /**
     * @return float
     */
    public function getBaseVolume();

    /**
     * @return float
     */
    public function getQuoteVolume();

    /**
     * @return float
     */
    public function getChange();
}