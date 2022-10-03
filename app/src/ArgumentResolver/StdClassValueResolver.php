<?php

namespace App\ArgumentResolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class StdClassValueResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === \StdClass::class;
#        return $argument->getType() instanceof \StdClass;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        yield new \StdClass();
    }
}
