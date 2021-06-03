<?php

namespace App\Models;
/**
 * Class User
 * @package App\Models
 */
class User
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var boolean
     */
    public $status;

    /**
     * @var boolean
     */
    public $fullName;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $created;

    /**
     * @var string
     */
    public $updated;
}
