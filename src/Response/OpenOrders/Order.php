<?php

namespace Xoptov\TradingPlatform\Response\OpenOrders;

use Xoptov\TradingPlatform\Model\RateTrait;

class Order
{
	use RateTrait;

	/** @var string */
	private $id;

	/**
	 * Order constructor.
	 * @param string $id
	 * @param float $price
	 * @param float $volume
	 */
	public function __construct($id, $price, $volume)
	{
		$this->id = $id;
		$this->price = $price;
		$this->volume = $volume;
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}
}