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

        //TODO: need implement binding for traders.

        // Starting event loop in provider.
        $this->provider->start();
    }
}