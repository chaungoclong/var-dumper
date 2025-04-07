<?php

declare(strict_types=1);

namespace DragonTNT\VarDumper;

use ReflectionObject;

abstract class AbstractDumper implements DumperInterface
{
    protected string $line = '';

    protected function getObjectProperties($object): array
    {
        $reflection = new ReflectionObject($object);
        $properties = [];

        foreach ($reflection->getProperties() as $prop) {
            $prop->setAccessible(true);
            $properties[$prop->getName()] = $prop->getValue($object);
        }

        $arrayCast = (array)$object;
        $castProperties = [];

        foreach ($arrayCast as $castKey => $castValue) {
            $cleanKey = $castKey;
            if (strpos($castKey, "\0") !== false) {
                $parts = explode("\0", $castKey);
                $cleanKey = end($parts);
            }
            $castProperties[$cleanKey] = $castValue;
        }

        return array_merge($castProperties, $properties);
    }
}