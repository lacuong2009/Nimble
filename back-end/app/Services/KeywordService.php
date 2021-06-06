<?php

namespace App\Services;
use App\Common\Reader\Adapter;
use App\Entities\Keyword;
use App\Exceptions\NotFoundException;
use App\Helpers\KeywordHelper;
use App\Jobs\CrawlerJob;
use App\Repositories\KeywordRepository;
use App\Utility;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

/**
 * Class KeywordService
 * @package App\Services
 */
class KeywordService extends BaseService
{
    /**
     * @param UploadedFile $file
     * @return bool
     * @throws \Exception
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

        return true;
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

//            if ($this->isFullQuota()) {
//                // fire job, Use queue db
//                dispatch(new CrawlerJob(Keyword::class, $entity->id));
//            } else {
//                // store queue to db
//                /** @var QueueService $queue */
//                $queue = app('QueueService');
//                $queue->push($entity);
//            }
        }

        return $entity;
    }

    /**
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function isFullQuota() : bool
    {
        $quota = env('QUOTA_LIMIT_PER_DAY') ?? 100;
        return $quota >= $this->getNumberImportToday();
    }

    /**
     * @return int|mixed|string|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getNumberImportToday() : bool
    {
        /** @var KeywordRepository $repos */
        $repos = $this->getRepository(Keyword::class);
        $result = $repos->getNumberImportByDate(Carbon::now());

        return !empty($result['num']) ? $result['num'] : 0;
    }

    /**
     *
     */
    public function scheduleKeyword()
    {
        $quota = env('QUOTA_LIMIT_PER_DAY') ?? 100;
        $now = Carbon::now();
        /** @var KeywordRepository $repos */
        $repos = $this->getRepository(Keyword::class);
        $queues = $repos->getScheduleKeywords($now, $quota);
        /** @var QueueService $queueService */
        $queueService = app('QueueService');

        if (count($queues) > 0) {
            foreach ($queues as $queue) {
                dispatch(new CrawlerJob(Keyword::class, $queue->keyword->id));
                $queueService->delete($queue->id);
            }
        }
    }

    /**
     * @param $params
     * @param $page
     * @param $limit
     * @return array
     */
    public function search($params, $page, $limit)
    {
        $criteria = (object) $params;
        /** @var KeywordRepository $repos */
        $repos = $this->getRepository(Keyword::class);
        $paginator = $repos->search($criteria, $page, $limit);
        $keywords = $paginator->getQuery()->getResult();
        $items = [];

        foreach ($keywords as $key => $keyword) {
            $items[$key] = KeywordHelper::makeModelKeyword($keyword);
            unset($items[$key]->html);
        }

        return [
            'items' => $items,
            'total' => $paginator->count(),
            'page' => (int)$page,
            'limit' => (int)$limit,
        ];
    }

    /**
     * @param $id
     * @return \App\Models\Keyword
     * @throws NotFoundException
     */
    public function show($id)
    {
        /** @var Keyword $entity */
        $entity = $this->getRepository(Keyword::class)->find($id);

        if (empty($entity)) {
            throw new NotFoundException('Not found Keyword');
        }

        return KeywordHelper::makeModelKeyword($entity);
    }
}
