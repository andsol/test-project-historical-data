<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 13:32
 */

namespace App\Gateway;

use GuzzleHttp\Client;

class SymbolDataGatewayFactory
{
    public static function create()
    {
        $client = new Client();
        $gateway = new SymbolDataHttpGateway($client);

        return $gateway;
    }
}