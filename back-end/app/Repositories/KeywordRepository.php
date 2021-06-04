<?php

namespace App\Repositories;

use App\Entities\Keyword;
use App\Entities\QueueKeyWord;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;

/**
 * Class KeywordRepository
 * @package App\Repositories
 */
class KeywordRepository extends EntityRepository
{
    /**
     * @param Carbon $date
     * @return int|mixed|string|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getNumberImportByDate(Carbon $date)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $query = $qb->select('COUNT(k) as num')
                ->from(Keyword::class, 'k')
                ->where(
                    $qb->expr()->between('k.created', ':start', ':end')
                )
                ->setParameter('start', $date->startOfDay()->toIso8601String())
                ->setParameter('end', $date->endOfDay()->toIso8601String());

        return $query->getQuery()->getOneOrNullResult();
    }

    /**
     * @param Carbon $date
     * @param int $limit
     * @return int|mixed|string
     */
    public function getScheduleKeywords(Carbon $date, $limit = 10)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $query = $qb->select('q')
            ->from(QueueKeyWord::class, 'q')
            ->where(
                $qb->expr()->lte('q.created', ':created')
            )
            ->setParameter('created', $date->toIso8601String())
            ->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }
}
