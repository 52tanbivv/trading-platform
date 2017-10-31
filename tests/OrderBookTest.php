<?php

namespace Xoptov\TradingPlatform\Tests;

use PHPUnit\Framework\TestCase;
use Xoptov\TradingPlatform\Model\Rate;
use Xoptov\TradingPlatform\OrderBook;
use Xoptov\TradingPlatform\Model\Order;

class OrderBookTest extends TestCase
{
	public function testAdd()
	{
		$asks = array(
			array(1.7261, 22),
			array(1.7270, 1),
			array(1.7280, 1),
			array(1.7271, 1),
			array(1.7260, 3)
		);

		$bids = array(
			array(1.7210, 1),
			array(1.7240, 1),
			array(1.7200, 1),
			array(1.7220, 1),
			array(1.7230, 1)
		);

		$orderBook = new OrderBook();

		foreach ($asks as $ask) {
			$rate = new Rate($ask[0], $ask[1]);
			$orderBook->add(Order::TYPE_ASK, $rate);
		}

		foreach ($bids as $bid) {
			$rate = new Rate($bid[0], $bid[1]);
			$orderBook->add(Order::TYPE_BID, $rate);
		}
	}
}