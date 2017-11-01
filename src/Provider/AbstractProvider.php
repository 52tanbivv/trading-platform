<?php

namespace Xoptov\TradingPlatform\Provider;

use SplObserver;
use SplDoublyLinkedList;
use Xoptov\TradingPlatform\Channel\PushChannel;
use Xoptov\TradingPlatform\Message\MessageInterface;

abstract class AbstractProvider implements ProviderInterface
{
	/** @var array */
	protected $supportChannels = array(
		MessageInterface::TYPE_TICKER,
		MessageInterface::TYPE_ORDER_BOOK,
		MessageInterface::TYPE_TRADE
	);

	/** @var SplDoublyLinkedList */
	private $channels;

	/**
	 * AbstractProvider constructor.
	 */
	public function __construct()
	{
		$this->channels = $this->createChannels();
	}

	/**
	 * {@inheritdoc}
	 */
	public function bindChannel($type, SplObserver $observer)
	{
		/** @var PushChannel $channel */
		foreach ($this->channels as $channel) {
			if ($channel->getType() === $type) {
				$channel->attach($observer);
			}
		}
	}

	/**
	 * @return array
	 */
	public function getSupportChannels()
	{
		return $this->supportChannels;
	}

	/**
	 * @param int $type
	 * @param MessageInterface $message
	 */
	protected function propagate($type, MessageInterface $message)
	{
		/** @var PushChannel $channel */
		foreach ($this->channels as $channel) {
			if ($channel->getType() === $type) {
				$channel->setMessage($message)->notify();
			}
		}
	}

	/**
	 * @return SplDoublyLinkedList
	 */
	private function createChannels()
	{
		$channels = new SplDoublyLinkedList();

		foreach ($this->supportChannels as $type) {
			$channels->push(new PushChannel($type));
		}

		return $channels;
	}
}