<?php


namespace App\Models;

/**
 * Class Keyword
 * @package App\Models
 */
class Keyword
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $keyword;

    /**
     * @var int
     */
    public $totalAdWords;

    /**
     * @var int
     */
    public $totalLinks;

    /**
     * @var int
     */
    public $totalResults;

    /**
     * @var float
     */
    public $totalResultSeconds;

    /**
     * @var string
     */
    public $html;
}
