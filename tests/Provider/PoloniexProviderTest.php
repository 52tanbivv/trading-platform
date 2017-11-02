<?php

namespace Xoptov\TradingPlatform\Tests\Provider;

use PHPUnit\Framework\TestCase;
use Xoptov\TradingPlatform\Provider\PoloniexProvider;

class PoloniexProviderTest extends TestCase
{
	public function testCurrencies()
	{
        $mockContent = "{\"AMP\":{\"id\":275,\"name\":\"Synereo AMP\",\"txFee\":\"5.00000000\",\"minConf\":1,\"depositAddress\":null,\"disabled\":0,\"delisted\":0,\"frozen\":0},\"BBR\":{\"id\":15,\"name\":\"Boolberry\",\"txFee\":\"0.00500000\",\"minConf\":10,\"depositAddress\":null,\"disabled\":0,\"delisted\":1,\"frozen\":0},\"BCC\":{\"id\":16,\"name\":\"BTCtalkcoin\",\"txFee\":\"0.01000000\",\"minConf\":15,\"depositAddress\":null,\"disabled\":0,\"delisted\":1,\"frozen\":0},\"BCH\":{\"id\":292,\"name\":\"Bitcoin Cash\",\"txFee\":\"0.00010000\",\"minConf\":6,\"depositAddress\":null,\"disabled\":0,\"delisted\":0,\"frozen\":0}}";

	    $options = array(
	        "rps" => 6,
            "http" => array(
                "base_uri" => "https://poloniex.com"
            )
        );

		$provider = new PoloniexProvider($options);
		$response = $provider->currencies();
	}
}