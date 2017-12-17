<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 14:18
 */

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Symbol extends Constraint
{
    public $message = 'Symbol "{{ string }}" not exist.';
}