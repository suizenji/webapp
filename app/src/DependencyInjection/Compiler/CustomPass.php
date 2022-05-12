<?php

namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @see https://symfony.com/doc/current/service_container/compiler_passes.html
 * @see https://tomasvotruba.com/blog/2018/05/17/how-to-test-private-services-in-symfony/
 */
class CustomPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $containerBuilder): void
    {
        if (!$this->isPHPUnit()) {
            return;
        }

        foreach ($containerBuilder->getDefinitions() as $definition) {
            if (is_null($class = $definition->getClass())) {
                continue;
            }

            if ((preg_match('/^App\\\\/', $class) <= 0)) {
                continue;
            }

            $definition->setPublic(true);
        }

        // TODO judge App or not
        /*
        foreach ($containerBuilder->getAliases() as $definition) {
            $definition->setPublic(true);
        }
        */
    }

    private function isPHPUnit(): bool
    {
        // there constants are defined by PHPUnit
        return defined('PHPUNIT_COMPOSER_INSTALL') || defined('__PHPUNIT_PHAR__');
    }
}
