<?php

namespace Xoptov\TradingPlatform;

use Xoptov\TradingPlatform\Model\Order;
use Xoptov\TradingPlatform\Model\Trade;
use Xoptov\TradingPlatform\Model\Active;
use Xoptov\TradingPlatform\Trader\TraderInterface;

interface PlatformInterface
{
    /**
     * @param TraderInterface $consumer
     * @return OrderBook
     */
    public function getOrderBook(TraderInterface $consumer);

    /**
     * @param TraderInterface $consumer
     * @return Active[]
     */
    public function getActives(TraderInterface $consumer);

    /**
     * @param TraderInterface $consumer
     * @return Order[]
     */
    public function getOrders(TraderInterface $consumer);

	/**
	 * @param TraderInterface $consumer
	 * @return Trade[]
	 */
    public function getTrades(TraderInterface $consumer);
}