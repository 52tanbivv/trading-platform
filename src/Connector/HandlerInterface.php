<?php

namespace Xoptov\TradingBot\Connector;

interface HandlerInterface
{
    public function onTick(array $data);

    public function onBook(array $data);

    public function onTrade(array $data);
}