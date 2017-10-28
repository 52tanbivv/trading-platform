<?php

namespace Xoptov\TradingBot\Model;

abstract class AbstractActive
{
	/** @var Currency */
	private $currency;

	/** @var float */
	protected $volume;

	/**
	 * AbstractActive constructor.
	 * @param Currency $currency
	 * @param float $volume
	 */
	public function __construct(Currency $currency, $volume)
	{
		$this->currency = $currency;
		$this->volume = $volume;
	}

	/**
	 * @return Currency
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * @return float
	 */
	public function getVolume()
	{
		return $this->volume;
	}
}