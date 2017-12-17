<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17-Dec-17
 * Time: 14:19
 */

namespace App\Validator\Constraints;


use App\Gateway\SymbolGatewayInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SymbolValidator extends ConstraintValidator
{
    private $gateway;

    public function __construct(SymbolGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!array_key_exists($value, $this->gateway->fetchAll())) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}