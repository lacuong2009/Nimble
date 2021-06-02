<?php


namespace App\Entities;

/**
 * Class BaseEntity
 * @package App\Entities
 */
class BaseEntity
{
    use TraitEntity;

    /**
     * @return array
     */
    public function toSimpleArray()
    {
        return get_object_vars($this);
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        throw new \BadMethodCallException('Unknown property on ' . get_called_class() . '::__get(' . $property . ')');
    }

    /**
     * @param $property
     * @param $value
     * @return mixed
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            return $this->$property = $value;
        }

        throw new \BadMethodCallException('Unknown property on ' . get_called_class() . '::__set(' . $property . ')');
    }
}
