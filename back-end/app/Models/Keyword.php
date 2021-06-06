<?php


namespace App\Models;

/**
 * Class Keyword
 * @package App\Models
 *
 * @OA\Schema(
 *     description="Keyword",
 *     title="Keyword",
 *     required={},
 *     @OA\Xml(
 *         name="Keyword"
 *     )
 * )
 */
class Keyword
{
    /**
     * @OA\Property()
     * @var int
     */
    public $id;

    /**
     * @OA\Property()
     * @var string
     */
    public $keyword;

    /**
     * @OA\Property()
     * @var int
     */
    public $totalAdWords;

    /**
     * @OA\Property()
     * @var int
     */
    public $totalLinks;

    /**
     * @OA\Property()
     * @var int
     */
    public $totalResults;

    /**
     * @OA\Property()
     * @var float
     */
    public $totalResultSeconds;

    /**
     * @OA\Property()
     * @var string
     */
    public $html;
}
