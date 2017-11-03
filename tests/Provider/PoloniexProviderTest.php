<?php

namespace Xoptov\TradingPlatform\Tests\Provider;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Xoptov\TradingPlatform\Provider\PoloniexProvider;
use Xoptov\TradingPlatform\Response\Currencies\Response as CurrenciesResponse;

class PoloniexProviderTest extends TestCase
{
	public function testCurrencies()
	{
        $content = "{
            \"BTC\":{\"id\":1,\"name\":\"Bitcoin\",\"txFee\":\"0.00010000\",\"minConf\":6,\"depositAddress\":null,\"disabled\":0,\"delisted\":0,\"frozen\":0},
            \"BCH\":{\"id\":2,\"name\":\"Bitcoin Cash\",\"txFee\":\"0.00010000\",\"minConf\":6,\"depositAddress\":null,\"disabled\":0,\"delisted\":0,\"frozen\":0},
            \"ETH\":{\"id\":3,\"name\":\"Ethereum\",\"txFee\":\"0.00010000\",\"minConf\":6,\"depositAddress\":null,\"disabled\":0,\"delisted\":0,\"frozen\":0}
        }";

        $mockResponse = $this->createMock(Response::class);
        $mockResponse
	        ->expects($this->once())
            ->method("getBody")
			->willReturn($content);

        $mockResponse
	        ->expects($this->once())
            ->method("getStatusCode")
            ->willReturn(200);

        $mockHttpClient = $this->createPartialMock(Client::class, ["request"]);
        $mockHttpClient
	        ->expects($this->once())
	        ->method("request")
	        ->willReturn($mockResponse);

	    $options = array(
	        "rps" => 6,
            "http" => array(
                "base_uri" => "https://poloniex.com"
            )
        );

		/**
		 * @var Client $mockHttpClient
		 */

		$provider = new PoloniexProvider($mockHttpClient, $options);
		$response = $provider->currencies();

		$this->assertInstanceOf(CurrenciesResponse::class, $response);
		$this->assertCount(3, $response->getCurrencies());
	}


}