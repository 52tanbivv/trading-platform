<?php

namespace Xoptov\TradingPlatform\Message;

interface MessageInterface
{
	const TYPE_TICKER = 1;
	const TYPE_ORDER_BOOK = 2;
	const TYPE_TRADE = 4;
}