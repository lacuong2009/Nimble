<?php


namespace App\Helpers;


use App\Entities\BaseEntity;
use App\Models\Keyword;
use App\Utility;

/**
 * Class KeywordHelper
 * @package App\Helpers
 */
class KeywordHelper
{
    /**
     * @param BaseEntity $entity
     * @return Keyword
     */
    public static function makeModelKeyword(BaseEntity $entity) : Keyword
    {
        $model = new Keyword();
        Utility::updateArrayToObject($entity->toSimpleArray(), $model, []);

        return $model;
    }
}
