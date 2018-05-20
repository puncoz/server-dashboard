<?php

namespace Puncoz\ServerDashboard\Repositories;

use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Puncoz\ServerDashboard\Contracts\DatabaseStatsRepository;

/**
 * Class PostgresDatabaseStatsRepository
 * @package Puncoz\ServerDashboard\Repositories
 */
class PostgresDatabaseStatsRepository implements DatabaseStatsRepository
{
    /**
     * @var DatabaseManager
     */
    protected $database;

    /**
     * SqlDatabaseStatsRepository constructor.
     *
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->database = $databaseManager;
    }

    /**
     * @return bool
     */
    public function checkConnection(): bool
    {
        try {
            $this->connection()->getPdo();
        } catch (\PDOException $exception) {
            return false;
        }

        return true;
    }

    /**
     * @param array $dbTables
     *
     * @return array
     */
    public function getTablesStats(array $dbTables): array
    {
        $sql = collect($dbTables)->map(
            function (string $updatedAtColumn, string $tableName) {
                return "( SELECT a.tbl AS name, a.count AS row_count, b.updated_at AS last_updated_at
                            FROM (
                                   SELECT
                                     '{$tableName}' AS tbl,
                                     count(1) AS count
                                   FROM {$tableName}
                                 ) a
                              LEFT JOIN (
                                          SELECT
                                            '{$tableName}' AS tbl,
                                            {$updatedAtColumn} AS updated_at
                                          FROM {$tableName}
                                          ORDER BY {$updatedAtColumn}
                                          LIMIT 1
                                        ) b
                                ON a.tbl = b.tbl
                             )";
            }
        )->filter()->implode(' UNION ');

        return empty($dbTables) ? [] : $this->connection()->select($sql);
    }

    /**
     * @return Connection
     */
    private function connection(): Connection
    {
        return $this->database->connection();
    }
}
