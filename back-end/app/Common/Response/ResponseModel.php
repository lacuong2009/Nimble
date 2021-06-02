<?php


namespace App\Common\Response;

/**
 * Class ResponseModel
 * @package App\Common\Response
 */
class ResponseModel
{
    /**
     * @var bool
     */
    public $success = true;
    /**
     * @var integer
     */
    public $code = 200;

    /**
     * @var array
     */
    public $data = [];
}
