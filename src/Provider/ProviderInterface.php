<?php

namespace Xoptov\TradingPlatform\Provider;

use SplObserver;

interface ProviderInterface
{
    /**
     * @return void
     */
    public function start();

    /**
     * @param int $type
     * @param SplObserver $observer
     */
    public function bindChannel($type, SplObserver $observer);

	/**
	 * @return array
	 */
    public function getSupportChannels();

	/**
	 * @param string $name
	 * @param string $arguments
	 * @return mixed
	 */
    public function __call($name, $arguments);
}