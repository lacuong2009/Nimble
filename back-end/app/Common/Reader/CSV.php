<?php

namespace App\Common\Reader;

/**
 * Class CSV
 * @package App\Common\Response
 */
class CSV implements IReader
{
    private $handle;

    /**
     * CSV constructor.
     * @param null $fileName
     * @param string $mod
     * @throws \Exception
     */
    public function __construct($fileName = null, $mod = "r")
    {
        if ($fileName) {
            $this->open($fileName, $mod);
        }
    }

    /**
     * @param        $fileName
     * @param string $mod
     * @return resource
     * @throws \Exception
     */
    public function open($fileName, $mod = "r")
    {
        if (($handle = fopen($fileName, $mod)) !== false) {
            $this->handle = $handle;

            return $this->handle;
        }

        throw new \Exception('Can not open file', 10001);
    }

    public function setTitle($title = null)
    {

    }

    /**
     * close connection
     */
    public function close()
    {
        if ($this->handle) {

        }

        fclose($this->handle);
    }

    /**
     * @param int $size
     * @return array|false|mixed|null
     * @throws \Exception
     */
    public function readRow($size = 1000)
    {
        try {
            $data = fgetcsv($this->handle, $size, ",");

            if ($data === false) {
                fclose($this->handle);
            }

            return $data;
        } catch (\Exception $e) {
            throw new \Exception('Error while reading row', 10002);
        }
    }

    /**
     * @param $data
     * @throws \Exception
     */
    public function writeRow($data)
    {
        if (fputcsv($this->handle, $data) === false) {
            throw new \Exception('Error while writing row', 10002);
        }
    }
}
