<?php

namespace Puncoz\ServerDashboard\Http\Controllers;

use Puncoz\ServerDashboard\Exceptions\ConnectionFailedException;
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
        try {
            $dbTables = $databaseStats->getAllTables();
        } catch (ConnectionFailedException $exception) {
            return $this->jsonResponse(['connection' => false]);
        }

        return $this->jsonResponse($dbTables);
    }
}
