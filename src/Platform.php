<?php

namespace Xoptov\TradingPlatform;

use Xoptov\TradingPlatform\Provider\ProviderInterface;
use Xoptov\TradingPlatform\Trader\TraderInterface;

class Platform implements PlatformInterface
{
	/** @var ProviderInterface[] */
	private $providers;

	/** @var TraderInterface[] */
	private $traders;

	/**
	 * {@inheritdoc}
	 */
	public function getActives(TraderInterface $consumer)
	{
		// TODO: Implement getActives() method.
	}

	/**
	 * {@inheritdoc}
	 */
	public function getOrderBook(TraderInterface $consumer)
	{
		// TODO: Implement getOrderBook() method.
	}

	/**
	 * {@inheritdoc}
	 */
	public function getOrders(TraderInterface $consumer)
	{
		// TODO: Implement getOrders() method.
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTrades(TraderInterface $consumer)
	{
		// TODO: Implement getTrades() method.
	}
}