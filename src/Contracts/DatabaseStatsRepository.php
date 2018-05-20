<?php

namespace Puncoz\ServerDashboard\Contracts;

use Illuminate\Support\Collection;
use Puncoz\ServerDashboard\Exceptions\ConnectionFailedException;

/**
 * Interface DatabaseStatsRepository
 * @package Puncoz\ServerDashboard\Contracts
 */
interface DatabaseStatsRepository
{
    /**
     * @return bool
     */
    public function checkConnection(): bool;

    /**
     * @param array $dbTables
     *
     * @return array
     */
    public function getTablesStats(array $dbTables): array ;
}
