<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 13:22
 */

namespace App\Gateway;

use App\Entity\SymbolData;

interface SymbolDataGatewayInterface
{
    /**
     * @return SymbolData[]
     */
    public function fetch($symbolName, \DateTime $dateFrom, \DateTime $dateTo);
}