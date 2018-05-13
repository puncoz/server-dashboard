<?php

namespace Puncoz\ServerDashboard;

use Puncoz\ServerDashboard\Contracts\OnlineVisitorsRepository;
use Puncoz\ServerDashboard\Repositories\RedisOnlineVisitorsRepository;

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
    ];
}
