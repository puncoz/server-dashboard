<?php

namespace Puncoz\ServerDashboard\Contracts;

/**
 * Interface OnlineVisitorsRepository
 * @package Puncoz\ServerDashboard\Contracts
 */
interface OnlineVisitorsRepository
{
    /**
     * @param string $key
     * @param int    $start
     * @param int    $end
     *
     * @return int
     */
    public function getVisitorCount(string $key, int $start, int $end): int;
}
