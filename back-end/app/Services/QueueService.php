<?php


namespace App\Services;

use App\Entities\Keyword;
use App\Entities\QueueKeyword;
use App\Exceptions\NotFoundException;

/**
 * Class QueueService
 * @package App\Services
 */
class QueueService extends BaseService
{
    /**
     * @param $keyword
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function push(Keyword $keyword)
    {
        $queue = new QueueKeyword();
        $queue->keyword = $keyword;

        $this->getEntityManager()->persist($queue);
        $this->getEntityManager()->flush($queue);
    }

    /**
     * @param $id
     * @return object
     * @throws NotFoundException
     */
    public function pop($id)
    {
        $queue = $this->getRepository(QueueKeyword::class)->find($id);

        if (empty($queue)) {
            throw new NotFoundException('Queue not found');
        }

        return $queue;
    }

    /**
     * @param $id
     * @throws NotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($id)
    {
        try {
            $queue = $this->pop($id);
            $this->getEntityManager()->remove($queue);
            $this->getEntityManager()->flush($queue);
        } catch (NotFoundException $ex) {
            // nothing to do
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
