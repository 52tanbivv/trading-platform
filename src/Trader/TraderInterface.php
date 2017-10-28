<?php

namespace Xoptov\TradingPlatform\Trader;

use Xoptov\TradingPlatform\Account;
use Xoptov\TradingPlatform\Event\Tick;
use Xoptov\TradingPlatform\Event\Trade;
use Xoptov\TradingPlatform\Event\OrderBook;

interface TraderInterface
{
	/**
	 * @return Account
	 */
	public function getAccount();

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