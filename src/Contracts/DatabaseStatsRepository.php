<?php

namespace Puncoz\ServerDashboard\Contracts;

use Illuminate\Support\Collection;

/**
 * Interface DatabaseStatsRepository
 * @package Puncoz\ServerDashboard\Contracts
 */
interface DatabaseStatsRepository
{

    /**
     * @return Collection
     */
    public function tableList(): Collection;

    /**
     * @return bool
     */
    public function checkConnection(): bool;
}
