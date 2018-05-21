<?php

namespace Puncoz\ServerDashboard\Http\Controllers;

use Puncoz\ServerDashboard\Http\Requests\SqlQueryExecutionRequest;
use Puncoz\ServerDashboard\Services\SqlQueryService;

/**
 * Class SqlQueryController
 * @package Puncoz\ServerDashboard\Http\Controllers
 */
class SqlQueryController extends Controller
{
    /**
     * @param SqlQueryExecutionRequest $request
     *
     * @param SqlQueryService          $sqlQueryService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute(SqlQueryExecutionRequest $request, SqlQueryService $sqlQueryService)
    {
        $query = $request->get('query');

        $results = $sqlQueryService->execute($query);

        return $this->jsonResponse([]);
    }
}
