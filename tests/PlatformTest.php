<?php

namespace Xoptov\TradingPlatform\Tests;

use ReflectionObject;
use SplDoublyLinkedList;
use PHPUnit\Framework\TestCase;
use Xoptov\TradingPlatform\Platform;
use Xoptov\TradingPlatform\DataContainer;
use Xoptov\TradingPlatform\Model\Currency;
use Xoptov\TradingPlatform\Provider\PoloniexProvider;
use Xoptov\TradingPlatform\Provider\ProviderInterface;
use Xoptov\TradingPlatform\Response\Currencies\Response as CurrenciesResponse;

class PlatformTest extends TestCase
{
    public function testGetCurrenciesFromCache()
    {
        $currencies = new SplDoublyLinkedList();
        $currencies->push(new Currency("BTC", "Bitcoin"));
        $currencies->push(new Currency("BCH", "Bitcoin Cash"));
        $currencies->push(new Currency("ETH", "Ethereum"));

        $dataContainer = $this->createMock(DataContainer::class);
        $dataContainer->expects($this->once())
            ->method("isFresh")
            ->willReturn(true);
        $dataContainer->expects($this->once())
            ->method("getData")
            ->willReturn($currencies);

        /** @var ProviderInterface $mockProvider */
        $mockProvider = $this->createMock(PoloniexProvider::class);
        $platform = new Platform($mockProvider);
        $reflection = new ReflectionObject($platform);
        $property = $reflection->getProperty("currencies");
        $property->setAccessible(true);
        $property->setValue($platform, $dataContainer);

        $result = $platform->getCurrencies();

        // Assertion
        $this->assertInstanceOf(SplDoublyLinkedList::class, $result);
        $this->assertCount(3, $result);
    }

    public function testGetCurrenciesFromProvider()
    {
        $currencies = new SplDoublyLinkedList();
        $currencies->push(new Currency("BTC", "Bitcoin"));
        $currencies->push(new Currency("BCH", "Bitcoin Cash"));
        $currencies->push(new Currency("ETH", "Ethereum"));

        $dataContainer = $this->createMock(DataContainer::class);
        $dataContainer->expects($this->once())
            ->method("isFresh")
            ->willReturn(false);
        $dataContainer->expects($this->once())
            ->method("setData")
            ->with($currencies)
            ->willReturnSelf();

        $response = new CurrenciesResponse();
        $reflection = new ReflectionObject($response);
        $property = $reflection->getProperty("currencies");
        $property->setAccessible(true);
        $property->setValue($response, $currencies);

        $mockProvider = $this->createMock(PoloniexProvider::class);
        $mockProvider->expects($this->once())
            ->method("__call")
            ->with($this->equalTo("currencies"), $this->equalTo([]))
            ->willReturn($response);

        /** @var ProviderInterface $mockProvider */
        $platform = new Platform($mockProvider);
        $reflection = new ReflectionObject($platform);
        $property = $reflection->getProperty("currencies");
        $property->setAccessible(true);
        $property->setValue($platform, $dataContainer);
        $result = $platform->getCurrencies();

        // Assertion
        $this->assertInstanceOf(SplDoublyLinkedList::class, $result);
        $this->assertCount(3, $result);
    }
}