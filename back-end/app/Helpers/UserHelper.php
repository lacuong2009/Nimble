<?php

namespace App\Helpers;

use App\Entities\BaseEntity;
use App\Exceptions\NotFoundException;
use App\Models\User;
use App\Utility;
use Carbon\Carbon;
use Doctrine\ORM\EntityManager;

/**
 * Class UserHelper
 * @package App\Helpers
 */
class UserHelper
{
    /**
     * @var User
     */
    private static $user;

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

    /**
     * @param BaseEntity $entity
     */
    public static function setUser(BaseEntity $entity)
    {
        static::$user = static::makeModelUser($entity);
    }

    /**
     * @return \App\Entities\User
     * @throws NotFoundException
     */
    public static function getUser() : \App\Entities\User
    {
        /** @var EntityManager $em */
        $em = app(EntityManager::class);

        /** @var \App\Entities\User $user */
        $user = $em->getRepository(\App\Entities\User::class)->find(static::$user->id);

        if (empty($user)) {
            throw new NotFoundException('User not found');
        }

        return $user;
    }
}
