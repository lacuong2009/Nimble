<?php

namespace App\Helpers;

use App\Entities\BaseEntity;
use App\Models\User;
use App\Utility;
use Carbon\Carbon;

/**
 * Class UserHelper
 * @package App\Helpers
 */
class UserHelper
{
    /**
     * @param BaseEntity $entity
     * @return User
     */
    public static function makeModelUser(BaseEntity $entity) : User
    {
        $model = new User();
        Utility::updateArrayToObject($entity->toSimpleArray(), $model, ['created', 'updated']);
        $model->created = Carbon::instance($entity->created)->toIso8601String();
        $model->updated = Carbon::instance($entity->updated)->toIso8601String();

        return $model;
    }
}
