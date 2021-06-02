<?php

namespace App\Common\Driver\PDOPgSql;

use Doctrine\DBAL\Schema\PostgreSqlSchemaManager;
use Doctrine\DBAL\Schema\Sequence;


class CustomPostgreSqlSchemaManager extends PostgreSqlSchemaManager
{
    /**
     * @var array
     */
    private $existingSchemaPaths;

    /**
     * {@inheritdoc}
     */
    protected function _getPortableSequenceDefinition($sequence)
    {
        if ($sequence['schemaname'] != 'public') {
            $sequenceName = $sequence['schemaname'] . "." . $sequence['relname'];
        } else {
            $sequenceName = $sequence['relname'];
        }

        $version = floatval($this->_conn->getWrappedConnection()->getServerVersion());

        if ($version >= 10) {
            $data = $this->_conn->fetchAll('SELECT min_value, increment_by FROM pg_sequences WHERE schemaname = \'public\' AND sequencename = '.$this->_conn->quote($sequenceName));
        }
        else
        {
            $data = $this->_conn->fetchAll('SELECT min_value, increment_by FROM ' . $this->_platform->quoteIdentifier($sequenceName));
        }

        return new Sequence($sequenceName, $data[0]['increment_by'], $data[0]['min_value']);
    }
}
