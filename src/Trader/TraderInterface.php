<?php

namespace Xoptov\TradingPlatform\Trader;

use Xoptov\TradingPlatform\Message\Tick;
use Xoptov\TradingPlatform\Message\Trade;
use Xoptov\TradingPlatform\Message\OrderBook;

interface TraderInterface
{
    /**
     * @return int
     */
    public function supportChannels();

	/**
	 * @param Tick $event
	 * @return void
	 */
	public function onTick(Tick $event);

	/**
	 * @param OrderBook $event
	 * @return void
	 */
	public function onOrderBook(OrderBook $event);

	/**
	 * @param Trade $event
	 * @return void
	 */
	public function onTrade(Trade $event);
}