<?php

namespace Xoptov\TradingPlatform;

use SplSubject;
use SplObserver;
use SplDoublyLinkedList;
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
        $this->provider->bindAllChannels($this);
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

        //TODO: need implement binding for traders.

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