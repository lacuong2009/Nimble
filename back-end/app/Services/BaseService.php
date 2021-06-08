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

    /**
     * check DatabaseConnection
     */
    public function checkDatabaseConnection()
    {
        $conn = $this->getEntityManager()->getConnection();

        try {
            if (!$this->getEntityManager()->isOpen()) {
                $this->entityManager = $this->recreateEM($this->getEntityManager());
            }

            if (!$conn->ping()) {
                $this->reconnect($this->getEntityManager());
            };
        } catch (\Exception  $e) {
            $this->reconnect($this->getEntityManager());
        }
    }

    /**
     * @param EntityManager $entityManager
     * @return EntityManager
     */
    public function recreateEM(EntityManager $entityManager)
    {
        $newEm = EntityManager::create(
            $entityManager->getConnection(),
            $entityManager->getConfiguration(),
            $entityManager->getEventManager()
        );

        $this->entityManager = $newEm;

        app()->singleton(EntityManager::class, function () use ($newEm) {
            return $newEm;
        });

        return $newEm;
    }

    /**
     * @param EntityManager $entityManager
     */
    public function reconnect(EntityManager $entityManager)
    {
        echo "Reconnecting database" . PHP_EOL;

        $entityManager->getConnection()->close();
        $entityManager->clear();
    }
}
