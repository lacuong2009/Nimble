<?php

namespace App\Common\Reader;

/**
 * Class Adapter
 * @package Pegasus\Api\Common\Lib\Importer
 */
class Adapter implements IReader
{
    /**
     * @var IReader
     */
    private $reader;

    /**
     * Adapter constructor.
     * @param null $fileName
     * @param string $mod
     * @param null $extension
     * @throws \Exception
     */
    public function __construct($fileName = null, $mod = "r", $ext = null)
    {
        if (!$ext) {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        }

        if ($ext === 'csv') {
            $this->reader = new CSV($fileName, $mod);
        }
    }

    /**
     * @param null $title
     */
    public function setTitle($title = null)
    {

    }

    /**
     * @param        $fileName
     * @param string $mod
     * @return resource
     * @throws \Exception
     */
    public function open($fileName, $mod = "r")
    {
        $this->reader->open($fileName, $mod);
    }

    /**
     * close
     */
    public function close()
    {
        $this->reader->close();
    }

    /**
     * @param int $size
     * @return array|false
     * @throws \Exception
     */
    public function readRow($size = 1000)
    {
        return $this->reader->readRow($size);
    }

    /**
     * @param $data
     * @throws \Exception
     */
    public function writeRow($data)
    {
        return $this->reader->writeRow($data);
    }

    /**
     * @return IReader
     */
    public function getAdapter()
    {
        return $this->reader;
    }
}
