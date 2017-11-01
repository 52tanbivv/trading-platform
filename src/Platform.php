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
    /** @var boolean */
    private $started = false;

	/** @var ProviderInterface */
	private $provider;

	/** @var SplDoublyLinkedList */
	private $traders;

	/** @var DataContainer */
	private $currencies;

	/** @var DataContainer */
	private $currencyPairs;

	/** @var DataContainer */
	private $marketData;

	/** @var DataContainer */
	private $ticker;

	/** @var DataContainer */
	private $tradeHistory;

	/** @var DataContainer */
	private $chart;

    /**
     * Platform constructor.
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
        $this->traders = new SplDoublyLinkedList();
        $this->currencies = new DataContainer(86400);
        $this->currencyPairs = new DataContainer(86400);
        $this->marketData = new DataContainer(180);
        $this->ticker = new DataContainer(30);
        $this->tradeHistory = new DataContainer(30);
        $this->chart = new DataContainer(3600);
    }

    /**
     * @return bool
     */
    public function isStarted()
    {
        return $this->started;
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
        if ($this->started) {
            return;
        }

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
				if ($trader->isSupportMessage($type)) {
                    $this->provider->bindChannel($type, $trader);
				}
			}
        }

        //TODO: implement starting data receiving from market for pre filling important data.

        // Switch platform in started mode.
        $this->started = true;

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

    /**
     * @return SplDoublyLinkedList
     */
    public function getCurrencies()
    {
        if ($this->currencies->isFresh()) {
            $currencies = clone ($this->currencies)();

            return $currencies;
        }

        $response = $this->provider->currencies();

        if ($response) {
            //TODO: need implement handling response.
        }

        //TODO: need return result data.
    }
}