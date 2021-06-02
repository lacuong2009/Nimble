<?php


namespace App;

/**
 * Class Utility
 * @package App
 */
class Utility
{
    /**
     * @param array $array
     * @param $object
     * @param array $excludeProps
     * @param array $allowProps
     * @param bool $allowOverride
     */
    public static function updateArrayToObject(
        array $array,
        $object,
        $excludeProps = [],
        $allowProps = [],
        $allowOverride = true
    )
    {
        foreach ($array as $key => $value) {
            if (!is_null($value) && property_exists($object, $key)) {
                if ((count($allowProps) > 0 && in_array($key, $allowProps))
                    || !in_array($key, $excludeProps)
                ) {
                    if (empty($object->$key) || (!empty($object->$key) && $allowOverride)) {
                        $object->$key = $value;
                    }
                }
            }
        }
    }

    /**
     * @param $model
     * @param $entity
     * @param array $excludeProps
     * @param array $allowProps
     * @param bool $allowOverride
     */
    public static function updateModelToEntity(
        $model,
        $entity,
        $excludeProps = [],
        $allowProps = [],
        $allowOverride = true
    )
    {
        foreach ($model as $key => $value) {
            if ($value !== null) {
                if (property_exists($entity, $key)) {
                    if ((count($allowProps) > 0 && in_array($key, $allowProps))
                        || (!empty($excludeProps) && !in_array($key, $excludeProps))
                    ) {
                        if (empty($entity->$key) || (!empty($entity->$key) && $allowOverride)) {
                            $entity->$key = $value;
                        }
                    }
                }
            }
        }
    }
}
