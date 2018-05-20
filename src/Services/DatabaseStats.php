<?php

namespace Puncoz\ServerDashboard\Services;

use Puncoz\ServerDashboard\Contracts\DatabaseStatsRepository;
use Puncoz\ServerDashboard\Exceptions\ConnectionFailedException;

/**
 * Class DatabaseStats
 * @package Puncoz\ServerDashboard\Services
 */
class DatabaseStats
{
    /**
     * @var DatabaseStatsRepository
     */
    protected $databaseStatsRepository;
    /**
     * @var bool
     */
    protected $connectionStatus;

    /**
     * DatabaseStats constructor.
     *
     * @param DatabaseStatsRepository $databaseStatsRepository
     */
    public function __construct(
        DatabaseStatsRepository $databaseStatsRepository
    ) {
        $this->databaseStatsRepository = $databaseStatsRepository;

        $this->connectionStatus = $this->databaseStatsRepository->checkConnection();
    }

    /**
     * @return array
     * @throws ConnectionFailedException
     */
    public function getAllTables(): array
    {
        if (!$this->connectionStatus) {
            throw new ConnectionFailedException();
        }

        $dbTables = config('server-dashboard.db_tables');

        return $this->databaseStatsRepository->getTablesStats($dbTables);
    }
}
