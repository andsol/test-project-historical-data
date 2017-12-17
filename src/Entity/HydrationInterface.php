<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 15:11
 */

namespace App\Entity;

interface HydrationInterface
{
    public static function fromArray(array $data);

    /**
     * @return array
     */
    public function toArray();
}
