<?php

namespace Puncoz\ServerDashboard\Repositories;

use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
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
     * @return Connection
     */
    private function connection(): Connection
    {
        return $this->database->connection();
    }
}
