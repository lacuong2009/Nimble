<?php

namespace App\Common\Driver\PDOPgSql;

class Driver extends \Doctrine\DBAL\Driver\PDOPgSql\Driver
{
    /**
     * {@inheritdoc}
     */
    public function getSchemaManager(\Doctrine\DBAL\Connection $conn)
    {
        return new CustomPostgreSqlSchemaManager($conn);
    }
}
