<?php

namespace Xoptov\TradingPlatform;

class Account
{
	/** @var Balance */
	private $balance;

	/**
	 * Account constructor.
	 */
	public function __construct()
	{
		$this->balance = new Balance();
	}

	/**
	 * @return Balance
	 */
	public function getBalance()
	{
		$balance = clone $this->balance;

		return $balance;
	}
}