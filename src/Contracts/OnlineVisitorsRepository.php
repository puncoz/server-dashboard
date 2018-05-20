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
     * @param int    $end
     * @param int    $start
     *
     * @return int
     */
    public function getVisitorCount(string $key, int $end, int $start): int;

    /**
     * @param string $key
     * @param int    $score
     * @param string $member
     *
     * @return int
     */
    public function setVisitorLog(string $key, int $score, string $member): int;
}
