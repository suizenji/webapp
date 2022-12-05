<?php

namespace App\ArgumentResolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;

class AppArgumentResolver
{
    public function __construct(
        public ArgumentResolverInterface $resolver)
    {
    }

    public function getArguments(array $controller): array
    {
        $_controller = get_class($controller[0]) . '::' . $controller[1];
        $request = Request::createFromGlobals();
        $request->attributes->set('_controller', $_controller);

        return $this->resolver->getArguments($request, $controller);
    }
}
