<?php

namespace App\Repositories;

use App\Entities\Keyword;
use App\Entities\QueueKeyword;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

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
            ->from(QueueKeyword::class, 'q')
            ->where(
                $qb->expr()->lte('q.created', ':created')
            )
            ->setParameter('created', $date->toIso8601String())
            ->setMaxResults($limit)
            ->orderBy('q.id', 'asc');

        return $query->getQuery()->getResult();
    }

    /**
     * @param $criteria
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function search($criteria, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;

        $qb = $this->getEntityManager()->createQueryBuilder();
        $query = $qb->select('k')
            ->from(Keyword::class, 'k')
            ->where('1=1');

        if (!empty($criteria->keyword)) {
            $query->andWhere(
                $qb->expr()->like('k.keyword', ':keyword')
            )
            ->setParameter('keyword', $criteria->keyword . '%%');
        }

        $query
            ->orderBy('k.id', 'desc')
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        return new Paginator($query);
    }
}
