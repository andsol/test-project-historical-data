<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 13:22
 */

namespace App\Gateway;

interface SymbolDataGatewayInterface
{
    public function fetch($symbolName, $dateFrom, $dateTo);
}