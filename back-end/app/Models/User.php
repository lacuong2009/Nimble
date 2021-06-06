<?php

namespace App\Models;
/**
 * Class User
 * @package App\Models
 * @OA\Schema(
 *     description="User",
 *     title="User",
 *     required={},
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
{
    /**
     * @OA\Property(
     *     format="integer",
     *     description="Id",
     *     title="Id",
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     format="string",
     *     description="username",
     *     title="username",
     * )
     * @var string
     */
    public $username;

    /**
     * @OA\Property()
     * @var boolean
     */
    public $status;

    /**
     * @OA\Property()
     * @var boolean
     */
    public $fullName;

    /**
     * @OA\Property()
     * @var string
     */
    public $email;

    /**
     * @OA\Property()
     * @var string
     */
    public $created;

    /**
     * @OA\Property()
     * @var string
     */
    public $updated;
}
