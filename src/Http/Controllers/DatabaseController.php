<?php

namespace Puncoz\ServerDashboard\Http\Controllers;

use Puncoz\ServerDashboard\Services\DatabaseStats;

/**
 * Class DatabaseController
 * @package Puncoz\ServerDashboard\Http\Controllers
 */
class DatabaseController extends Controller
{
    /**
     * @param DatabaseStats $databaseStats
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tables(DatabaseStats $databaseStats)
    {
        $dbTables = $databaseStats->getAllTables();

        return $this->jsonResponse($dbTables);
    }
}
