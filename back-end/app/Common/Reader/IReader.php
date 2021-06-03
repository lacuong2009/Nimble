<?php

namespace App\Common\Reader;

/**
 * Class IReader
 * @package Pegasus\Api\Common\Lib\Importer
 */
interface IReader
{
    /**
     * @param $fileName
     * @param string $mod
     * @return resource
     * @throws \Exception
     */
    public function open($fileName, $mod = "r");

    /**
     * close connection
     */
    public function close();

    /**
     * @param null $title
     *
     * @return mixed
     */
    public function setTitle($title = null);

    /**
     * @param int $size
     * @return array
     */
    public function readRow($size = 1000);

    /**
     * @param $data
     */
    public function writeRow($data);
}
