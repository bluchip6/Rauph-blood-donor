<?php

namespace App\Core;

use ReflectionClass;

class Entity
{
    private int $id;

    /**
     * Entity constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \ReflectionProperty[]
     * @throws \ReflectionException
     */
    public function getObjectProperties()
    {
        $reflectionClass = new ReflectionClass($this);

        return $reflectionClass->getProperties();
    }

    /**
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $key = $this->snakeCaseToCamelCase($key);

            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    /**
     * @param string $key
     * @return string
     */
    public function snakeCaseToCamelCase(string $key): string
    {
        return lcfirst(str_replace('_', '', ucwords($key, '_')));
    }
}
