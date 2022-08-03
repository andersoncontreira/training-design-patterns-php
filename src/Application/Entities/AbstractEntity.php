<?php

declare(strict_types=1);


namespace Application\Entities;


use Application\Utils\ObjectUtils;
use ReflectionClass;

abstract class AbstractEntity implements EntityInterface
{
    /**
     * @throws \ReflectionException
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->populate($data);
        }
    }

    /**
     * @throws \ReflectionException
     */
    public function populate(array $data = null)
    {
        if ($data != null) {
            ObjectUtils::populate($this, $data);
        }
    }

    public static function getAttributes(): array
    {
        $attributes = [];
        $reflection = new ReflectionClass(static::class);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $attributes[] = $property->getName();
        }

        return $attributes;
    }
}
