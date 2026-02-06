<?php

namespace App\DTO;

use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionNamedType;

abstract class BaseDTO
{
    public static function fromArray(array $data): static
    {
        $ref = new ReflectionClass(static::class);
        $args = [];

        foreach ($ref->getConstructor()->getParameters() as $param) {
            $name = $param->getName();

            if (array_key_exists($name, $data)) {
                $args[] = $data[$name];
                continue;
            }

            if ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
                continue;
            }

            $type = $param->getType();
            if ($type instanceof ReflectionNamedType && $type->allowsNull()) {
                $args[] = null;
                continue;
            }

            throw new \InvalidArgumentException("Missing required parameter [$name] for " . static::class);
        }

        return new static(...$args);
    }

    public static function fromRequest(Request $request): static
    {
        return static::fromArray($request->all());
    }
}
