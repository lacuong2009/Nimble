<?php

namespace App\Services;

use Doctrine\ORM\EntityManager;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseService
{
    /**
     * @var  EntityManager
     */
    protected $entityManager;

    /**
     * @var int
     */
    protected $maxAttempt = 3;

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if ($this->entityManager === null) {
            $this->entityManager = app(EntityManager::class);
        } else {
            $this->entityManager = app(EntityManager::class);
        }

        return $this->entityManager;
    }
    /**
     * @param $entityName
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository($entityName)
    {
        return $this->getEntityManager()->getRepository($entityName);
    }
}
