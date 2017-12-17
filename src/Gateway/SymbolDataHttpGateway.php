<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 13:17
 */

namespace App\Gateway;


use GuzzleHttp\Client;

class SymbolDataHttpGateway implements SymbolDataGatewayInterface
{
    const URL = 'http://www.nasdaq.com/screening/companies-by-name.aspx?&render=download';

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetch($symbolName, $dateFrom, $dateTo)
    {
        try {
            $response = $this->client->get(self::URL);

            if ($response->getStatusCode() != 200) {
                throw  new \RuntimeException('Wrong header');
            }

            $csv = (string) $response->getBody();

            $array = str_getcsv($csv);

            foreach ($array as $row) {

            }

        } catch (\Exception $e) {
            throw new GatewayException('Can not fetch data from source', null, $e);
        }
    }
}