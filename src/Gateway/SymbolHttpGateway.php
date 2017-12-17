<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 13:17
 */

namespace App\Gateway;


use App\Entity\Symbol;
use GuzzleHttp\Client;

class SymbolHttpGateway implements SymbolGatewayInterface
{
    const URL = 'http://www.nasdaq.com/screening/companies-by-name.aspx?&render=download';

    private $client;
    private $data = [];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Symbol[]
     */
    public function fetchAll()
    {
        try {

            if ($this->data) {
                return $this->data;
            }

            $response = $this->client->get(self::URL);

            if ($response->getStatusCode() != 200) {
                throw  new \RuntimeException('Wrong header');
            }

            $csv = (string) $response->getBody();

            $rows = explode("\n", $csv);
            $columns = array_shift($rows);
            $columns = str_getcsv($columns, ',', '"');

            if (!count($rows)) {
                throw  new \RuntimeException('No data');
            }

            $result = [];
            foreach ($rows as $row) {
                $exploded = str_getcsv($row, ',', '"');

                if (count($exploded) != count($columns)) {
                    continue;
                }

                $data = array_combine($columns, $exploded);
                $result[$data['Symbol']] = Symbol::fromArray($data);
            }
            $this->data = $result;
            return $result;

        } catch (\Exception $e) {
            throw new GatewayException('Can not fetch data from source', null, $e);
        }
    }
}