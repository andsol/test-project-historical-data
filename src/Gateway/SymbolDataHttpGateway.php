<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 13:17
 */

namespace App\Gateway;


use App\Entity\SymbolData;
use GuzzleHttp\Client;

class SymbolDataHttpGateway implements SymbolDataGatewayInterface
{
    const URL = 'https://finance.google.com/finance/historical';

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetch($symbolName, \DateTime $dateFrom, \DateTime $dateTo)
    {
        try {
            $response = $this->client->get(self::URL, [
                \GuzzleHttp\RequestOptions::QUERY => [
                    'output' => 'csv',
                    'q' => $symbolName,
                    'startdate' => $dateFrom->format('M d, Y'),
                    'enddata' => $dateTo->format('M d, Y')
                ]
            ]);

            $csv = (string) $response->getBody();

            $rows = explode("\n", $csv);
            $columns = array_shift($rows);
            $columns = str_getcsv($columns, ',');

            if (!count($rows)) {
                throw  new \RuntimeException('No data');
            }

            $result = [];
            foreach ($rows as $row) {
                $exploded = str_getcsv($row, ',');

                if (count($exploded) != count($columns)) {
                    continue;
                }

                $data = array_combine($columns, $exploded);
                $result[] = SymbolData::fromArray($data);
            }
            $this->data = $result;
            return $result;

        } catch (\Exception $e) {
            throw new GatewayException('Can not fetch data from source', null, $e);
        }
    }
}