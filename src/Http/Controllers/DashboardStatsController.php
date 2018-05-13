<?php

namespace Puncoz\ServerDashboard\Http\Controllers;

use Puncoz\ServerDashboard\Services\OnlineCounter;
use Puncoz\ServerDashboard\Services\ServerStats;

/**
 * Class DashboardStatsController
 * @package Puncoz\ServerDashboard\Http\Controllers
 */
class DashboardStatsController extends Controller
{
    /**
     * @param OnlineCounter $onlineCounter
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function online(OnlineCounter $onlineCounter)
    {
        return response()->json(
            [
                'users'    => $onlineCounter->getOnlineUsersCount(),
                'visitors' => $onlineCounter->getOnlineVisitorsCount(),
            ]
        );
    }

    /**
     * @param ServerStats $serverStats
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function server(ServerStats $serverStats)
    {
        return response()->json(
            [
                'cpu'      => $serverStats->getCpuUsages(),
                'memory'   => $serverStats->getMemoryUsage(),
                'datetime' => [
                    'string'   => $serverStats->getServerDateTime()->toDateTimeString(),
                    'timezone' => $serverStats->getServerDateTime()->getTimezone(),
                ],
            ]
        );
    }
}
