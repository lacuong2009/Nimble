<?php

namespace App\Services;
use App\Common\Reader\Adapter;
use App\Entities\Keyword;
use App\Jobs\CrawlerJob;
use Illuminate\Http\UploadedFile;

/**
 * Class FileService
 * @package App\Services
 */
class FileService extends BaseService
{
    /**
     * @param UploadedFile $file
     */
    public function upload(UploadedFile $file)
    {
        $path = storage_path() . '/files/';

        if (!is_dir($path)) {
            mkdir($path);
        }

        $name = time() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $name);
        $this->process($path, $name);
    }

    /**
     * @param $path
     * @param $name
     * @throws \Exception
     */
    private function process($path, $name)
    {
        $filePath = $path . $name;
        $adapter = new Adapter($filePath);

        while ($row = $adapter->readRow()) {
            $keyword = reset($row);

            if (empty($keyword)) {
                continue;
            }

            $this->store($keyword);
        }
    }

    /**
     * @param $keyword
     * @return Keyword
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function store($keyword) : Keyword
    {
        $entity = $this->getRepository(Keyword::class)->findOneBy(['keyword' => $keyword]);

        if (empty($entity)) {
            $entity = new Keyword();
            $entity->keyword = trim($keyword);
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush($entity);

            // fire job
            dispatch(new CrawlerJob(Keyword::class, $entity->id));
        }

        return $entity;
    }
}
