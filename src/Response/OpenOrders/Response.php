<?php

namespace Xoptov\TradingBot\Response\OpenOrders;

class Response
{
	/** @var Order[] */
	private $orders = array();

	/**
	 * @return Order[]
	 */
	public function getOrders()
	{
		return $this->orders;
	}

	/**
	 * @param string $id
	 * @param float $price
	 * @param float $volume
	 * @return int
	 */
	public function addOrder($id, $price, $volume)
	{
		$order = new Order($id, $price, $volume);

		return array_push($this->orders, $order);
	}
}