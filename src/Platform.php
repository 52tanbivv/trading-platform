<?php

namespace Xoptov\TradingPlatform;

use SplSubject;
use SplObserver;
use SplDoublyLinkedList;
use Xoptov\TradingPlatform\Message\MessageInterface;
use Xoptov\TradingPlatform\Trader\TraderInterface;
use Xoptov\TradingPlatform\Provider\ProviderInterface;
use Xoptov\TradingPlatform\Exception\NoTradersException;

class Platform implements SplObserver
{
	/** @var ProviderInterface */
	private $provider;

	/** @var SplDoublyLinkedList */
	private $traders;

    /**
     * Platform constructor.
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
        $this->traders = new SplDoublyLinkedList();
    }

    /**
     * {@inheritdoc}
     */
	public function attach(TraderInterface $trader)
    {
        if ($this->traders->isEmpty()) {
        	$this->traders->push($trader);

        	return true;
        }

        foreach ($this->traders as $attached) {
        	if ($attached === $trader) {
        		return false;
	        }
        }

		$this->traders->push($trader);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function start()
    {
        if ($this->traders->isEmpty()) {
            throw new NoTradersException();
        }

        // Bind platform to ticker channel for message processing.
        $this->provider->bindChannel(MessageInterface::TYPE_TICKER, $this);

        // Bind platform to order book channel for message processing.
        $this->provider->bindChannel(MessageInterface::TYPE_ORDER_BOOK, $this);

        // Bind platform to trade channel for message processing.
        $this->provider->bindChannel(MessageInterface::TYPE_TRADE, $this);

        /** @var TraderInterface $trader */
	    foreach ($this->traders as $trader) {
			foreach ($this->provider->getSupportChannels() as $type) {
				if (!@$trader->isSupportMessage($type)) {
					continue;
				}

				$this->provider->bindChannel($type, $trader);
			}
        }

        //TODO: implement starting data receiving from market for pre filling important data.

        // Starting event loop in provider.
        $this->provider->start();
    }

	/**
	 * {@inheritdoc}
	 */
    public function update(SplSubject $subject)
    {
		return;
    }
}