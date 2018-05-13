<?php

namespace Puncoz\ServerDashboard\Repositories;

use Illuminate\Contracts\Redis\Factory as RedisFactory;
use Illuminate\Redis\Connections\Connection;
use Puncoz\ServerDashboard\Contracts\OnlineVisitorsRepository;

/**
 * Class RedisOnlineVisitorsRepository
 * @package Puncoz\ServerDashboard\Repositories
 */
class RedisOnlineVisitorsRepository implements OnlineVisitorsRepository
{
    /**
     * @var RedisFactory
     */
    protected $redis;

    /**
     * RedisOnlineVisitorsRepository constructor.
     *
     * @param RedisFactory $redis
     */
    public function __construct(RedisFactory $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param string $key
     * @param int    $start
     * @param int    $end
     *
     * @return int
     */
    public function getVisitorCount(string $key, int $start, int $end): int
    {
        return $this->connection()->zcount($key, $start, $end);
    }

    /**
     * Get the Redis connection instance.
     *
     * @return Connection
     */
    public function connection(): Connection
    {
        return $this->redis->connection('default');
    }
}
