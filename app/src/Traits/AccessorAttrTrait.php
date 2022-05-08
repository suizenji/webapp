<?php

namespace App\Traits;

/**
 * Usage:
 * #[Getter]
 * #[Setter]
 * private int $i;
 */
trait AccessorAttrTrait
{
    public function get(string $name): mixed
    {
        $reflection = new \ReflectionClass($this);
        $ns = $reflection->getNamespaceName();
        $prop = $reflection->getProperty($name);
        $attrName = $ns . '\Getter';

        if (!$prop->getAttributes($attrName)) {
            throw new \RuntimeException('Getter attr is not setted.');
        }

        return $prop->getValue($this);
    }

    public function set(string $name, $value)
    {
        $reflection = new \ReflectionClass($this);
        $ns = $reflection->getNamespaceName();
        $prop = $reflection->getProperty($name);
        $attrName = $ns . '\Setter';

        if (!$prop->getAttributes($attrName)) {
            throw new \RuntimeException('Setter attr is not setted.');
        }

        $prop->setValue($this, $value);
    }
}
