<?php

namespace Xoptov\TradingPlatform;

use Xoptov\TradingPlatform\Exception\NoTradersException;
use Xoptov\TradingPlatform\Provider\ProviderInterface;
use Xoptov\TradingPlatform\Trader\TraderInterface;

class Platform implements PlatformInterface
{
	/** @var ProviderInterface */
	private $provider;

	/** @var TraderInterface[] */
	private $traders;

    /**
     * Platform constructor.
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * {@inheritdoc}
     */
	public function attach(TraderInterface $trader)
    {
        if (in_array($trader, $this->traders)) {
            return false;
        }

        $this->traders[] = $trader;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function start()
    {
        if (empty($this->traders)) {
            throw new NoTradersException();
        }

        // Binding message handler from provider.
        foreach ($this->traders as $trader) {

            // Bind tick message if trader support it.
            if ($trader->supportChannels() & ProviderInterface::CHANNEL_TICKER) {
                $this->provider->bindTick(array($trader, "onTick"));
            }

            // Bind order book message if trader support it.
            if ($trader->supportChannels() & ProviderInterface::CHANNEL_ORDER_BOOK) {
                $this->provider->bindOrderBook(array($trader, "onOrderBook"));
            }

            // Bind trade message if trader support it.
            if ($trader->supportChannels() & ProviderInterface::CHANNEL_TRADE) {
                $this->provider->bindTrade(array($trader, "opnTrade"));
            }
        }

        // Starting event loop in provider.
        $this->provider->start();
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrencies(callable $handler)
    {
        // TODO: Implement getCurrencies() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrencyPairs(callable $handler)
    {
        // TODO: Implement getCurrencyPairs() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getMarketData(callable $handler)
    {
        // TODO: Implement getMarketData() method.
    }

    public function getOrderBook(callable $handler)
    {
        // TODO: Implement getOrderBook() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getTicker(callable $handler)
    {
        // TODO: Implement getTicker() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getTradeHistory(callable $handler)
    {
        // TODO: Implement getTradeHistory() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getBalance(Account $account, callable $handler)
    {
        // TODO: Implement getBalance() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getOpenOrders(Account $account, callable $handler)
    {
        // TODO: Implement getOpenOrders() method.
    }

    /**
     * {@inheritdoc}
     */
    public function placeOrder(Account $account, callable $handler)
    {
        // TODO: Implement placeOrder() method.
    }
}