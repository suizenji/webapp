<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ProtocolClassValidator extends ConstraintValidator
{
    public function validate($protocol, Constraint $constraint)
    {
        return;
        /*
          if ($protocol->getFoo() != $protocol->getBar()) {
          $this->context->buildViolation($constraint->message)
          ->atPath('foo')
          ->addViolation();
          }
        */
    }
}
