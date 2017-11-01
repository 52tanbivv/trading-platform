<?php

namespace Xoptov\TradingPlatform\Provider;

use SplDoublyLinkedList;

abstract class AbstractProvider implements ProviderInterface
{
	/** @var SplDoublyLinkedList */
	private $channels;

	public function __construct()
	{
		$this->channels = new SplDoublyLinkedList();
	}


}