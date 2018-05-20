<?php

namespace Puncoz\ServerDashboard\Services;

use Puncoz\ServerDashboard\Contracts\DatabaseStatsRepository;

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
     */
    public function getAllTables(): array
    {
        if ( !$this->connectionStatus ) {
            return [
                'status' => false,
            ];
        }

        $tables = $this->databaseStatsRepository->tableList();

        dd($tables);

        return [];
    }
}
