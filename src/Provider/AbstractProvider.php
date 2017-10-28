<?php

namespace Xoptov\TradingPlatform\Provider;

use Xoptov\TradingPlatform\Model\Currency;
use Xoptov\TradingPlatform\Model\CurrencyPair;
use Xoptov\TradingPlatform\OrderBook;

abstract class AbstractProvider implements ProviderInterface
{
	/** @var string */
	private $name;

	/** @var OrderBook */
	private $orderBook;

	/** @var Currency[] */
	private $currencies = array();

	/** @var CurrencyPair[] */
	private $currencyPairs = array();

	public function __construct($name)
	{
		$this->name = $name;
		$this->orderBook = new OrderBook();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return $this->name;
	}
}