<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(
    function () {
        Route::get('/stats/online', 'DashboardStatsController@online');
        Route::get('/stats/server', 'DashboardStatsController@server');
        Route::get('/database/tables', 'DatabaseController@tables');
    }
);

// Catch-all Route...
Route::get('/{view?}', 'HomeController@index')->where('view', '(.*)')->name('index');
