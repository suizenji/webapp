<?php

namespace App\Traits;

/**
 * Usage:
 *
 * #[Getter]
 * #[Setter]
 * private int $i;
 *
 * #[Getter('getFoo'), Setter('setFoo')]
 * private int $j;
 */
trait AccessorAttrTrait
{
    public function get(string $name): mixed
    {
        $refClass = new \ReflectionClass($this);
        $prop = $refClass->getProperty($name);

        $attrName = $refClass->getNamespaceName() . '\Getter';
        if (!($attrs = $prop->getAttributes($attrName))) {
            throw new \RuntimeException('Getter attr is not setted.');
        }

        $attr = $attrs[0];
        if (!($args = $attr->getArguments())) {
            return $prop->getValue($this);
        }

        $methodName = $args[0];
        if (!method_exists($this, $methodName)) {
            throw new \RuntimeException("method '${methodName}' is not found.");
        }

        $method = $refClass->getMethod($methodName);

        return $method->invoke($this);
    }

    public function set(string $name, mixed $value)
    {
        $refClass = new \ReflectionClass($this);
        $prop = $refClass->getProperty($name);

        $attrName = $refClass->getNamespaceName() . '\Setter';
        if (!($attrs = $prop->getAttributes($attrName))) {
            throw new \RuntimeException('Setter attr is not setted.');
        }

        $attr = $attrs[0];
        if (!($args = $attr->getArguments())) {
            return $prop->setValue($this, $value);
        }

        $methodName = $args[0];
        if (!method_exists($this, $methodName)) {
            throw new \RuntimeException("method '${methodName}' is not found.");
        }

        $method = $refClass->getMethod($methodName);

        return $method->invoke($this, $value);
    }
}
