<?php

namespace App\Traits;

/**
 * Usage:
 *
 * #[Getter]
 * #[Setter]
 * private int $i;
 *
 * #[Getter, Setter]
 * private int $j;
 */
trait AccessorAttrTrait
{
    public function get(string $name): mixed
    {
        $reflection = new \ReflectionClass($this);
        $prop = $reflection->getProperty($name);

        $attrName = $reflection->getNamespaceName() . '\Getter';
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

        $method = $reflection->getMethod($methodName);
        return $method->invoke($this);
    }

    public function set(string $name, mixed $value)
    {
        $reflection = new \ReflectionClass($this);
        $prop = $reflection->getProperty($name);

        $attrName = $reflection->getNamespaceName() . '\Setter';
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

        $method = $reflection->getMethod($methodName);
        return $method->invoke($this, $value);
    }
}
