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
     * @param int    $end
     * @param int    $start
     *
     * @return int
     */
    public function getVisitorCount(string $key, int $end, int $start): int
    {
        return $this->connection()->zcount($key, $start, $end);
    }

    /**
     * @param string $key
     * @param int    $score
     * @param string $member
     *
     * @return int
     */
    public function setVisitorLog(string $key, int $score, string $member): int
    {
        return $this->connection()->zadd($key, [$member => $score]);
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
