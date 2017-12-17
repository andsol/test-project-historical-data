<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 15:47
 */

namespace App\Entity;


use PHPUnit\Framework\TestCase;

class SymbolDataTest extends TestCase
{
    public function testBuildEntity()
    {
        $data = array (
            '﻿Date' => '15-Dec-17',
            'Open' => '1054.61',
            'High' => '1067.62',
            'Low' => '1049.50',
            'Close' => '1064.19',
            'Volume' => '3275931',
        );

        $object = SymbolData::fromArray($data);
        $this->assertInstanceOf(SymbolData::class, $object);
    }
}
