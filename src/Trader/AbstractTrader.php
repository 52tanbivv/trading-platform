<?php

namespace Xoptov\TradingPlatform\Trader;

use Xoptov\TradingPlatform\Account;
use Xoptov\TradingPlatform\PlatformInterface;

abstract class AbstractTrader implements TraderInterface
{
    /** @var Account */
    private $account;

    /** @var PlatformInterface */
    private $platform;

    /** @var array */
    private $supportChannels;

    /**
     * AbstractTrader constructor.
     * @param Account $account
     * @param PlatformInterface $platform
     * @param array $supportChannels
     */
    public function __construct(Account $account, PlatformInterface $platform, array $supportChannels = array())
    {
        $this->account = $account;
        $this->platform = $platform;
        $this->supportChannels = $supportChannels;
    }

    /**
     * {@inheritdoc}
     */
    public function supportChannels()
    {
        return array_sum($this->supportChannels);
    }
}