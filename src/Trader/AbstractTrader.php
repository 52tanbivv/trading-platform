<?php

namespace Xoptov\TradingPlatform\Trader;

use Xoptov\TradingPlatform\Platform;
use Xoptov\TradingCore\Model\Account;

abstract class AbstractTrader implements TraderInterface
{
    /** @var Account */
    private $account;

    /** @var Platform */
    private $platform;

    /** @var array */
    private $supportMessages;

    /**
     * AbstractTrader constructor.
     * @param Account $account
     * @param Platform $platform
     * @param array $supportMessages
     */
    public function __construct(Account $account, Platform $platform, array $supportMessages = array())
    {
        $this->account = $account;
        $this->platform = $platform;
        $this->supportMessages = $supportMessages;
    }

    /**
     * {@inheritdoc}
     */
    public function isSupportMessage($type)
    {
        return in_array($type, $this->supportMessages);
    }
}