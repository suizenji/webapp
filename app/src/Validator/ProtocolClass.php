<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ProtocolClass extends Constraint
{
    public $message = 'ProtocolClass message';

    /** @see https://symfony.com/doc/current/validation/custom_constraint.html#class-constraint-validator */
    public function getTargets() :string|array
    {
        return self::CLASS_CONSTRAINT;
    }
}
