<?php

namespace Puncoz\ServerDashboard;

use Puncoz\ServerDashboard\Contracts\DatabaseStatsRepository;
use Puncoz\ServerDashboard\Contracts\OnlineVisitorsRepository;
use Puncoz\ServerDashboard\Repositories\RedisOnlineVisitorsRepository;
use Puncoz\ServerDashboard\Repositories\PostgresDatabaseStatsRepository;

/**
 * Trait RepositoryBindings
 * @package Puncoz\ServerDashboard
 */
trait RepositoryBindings
{
    /**
     * All of the repository bindings for Server Dashboard.
     *
     * @var array
     */
    public $repositoryBindings = [
        OnlineVisitorsRepository::class => RedisOnlineVisitorsRepository::class,
        DatabaseStatsRepository::class  => PostgresDatabaseStatsRepository::class,
    ];
}
