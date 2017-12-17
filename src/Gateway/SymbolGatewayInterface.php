<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 13:23
 */

namespace App\Gateway;

use App\Entity\Symbol;

interface SymbolGatewayInterface
{
    /**
     * @return Symbol[]
     */
    public function fetchAll();
}