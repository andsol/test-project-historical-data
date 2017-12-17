<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 13:32
 */

namespace App\Gateway;

use GuzzleHttp\Client;

class SymbolGatewayFactory
{
    public static function create()
    {
        $client = new Client();
        $gateway = new SymbolHttpGateway($client);

        return $gateway;
    }
}