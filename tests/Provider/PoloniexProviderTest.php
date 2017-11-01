<?php

namespace Xoptov\TradingPlatform\Tests\Provider;

use DateTime;
use ReflectionObject;
use PHPUnit\Framework\TestCase;
use Xoptov\TradingPlatform\Provider\PoloniexProvider;

class PoloniexProviderTest extends TestCase
{
	public function testCheckRequestsLimit()
	{
		$provider = new PoloniexProvider(array(), 6);
		$reflection = new ReflectionObject($provider);
		$method = $reflection->getMethod("checkRequestsLimit");
		$method->setAccessible(true);

		$propertyLastRequestAt = $reflection->getProperty("lastRequestAt");
		$propertyLastRequestAt->setAccessible(true);
		$propertyLastRequestAt->setValue($provider, new DateTime());

		$this->assertTrue($method->invoke($provider));

		$propertyCounter = $reflection->getProperty("requestCounter");
		$propertyCounter->setAccessible(true);
		$propertyCounter->setValue($provider, 5);

		$this->assertTrue($method->invoke($provider));

		$propertyCounter = $reflection->getProperty("requestCounter");
		$propertyCounter->setAccessible(true);
		$propertyCounter->setValue($provider, 6);

		$provider->currencies();

		$this->assertFalse($method->invoke($provider));
	}
}