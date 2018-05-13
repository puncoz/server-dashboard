<?php

namespace Puncoz\ServerDashboard\Services;

use Carbon\Carbon;
use Puncoz\ServerDashboard\Contracts\OnlineVisitorsRepository;

/**
 * Class OnlineCounter
 * @package Puncoz\ServerDashboard\Services
 */
class OnlineCounter
{
    /**
     * @var float|int
     */
    protected $onlineMarginInSecond = 5 * 60;
    /**
     * @var OnlineVisitorsRepository
     */
    protected $visitorsRepository;
    /**
     * @var string
     */
    protected $keyPrefix = 'server-dashboard:online:';

    /**
     * OnlineCounter constructor.
     *
     * @param OnlineVisitorsRepository $visitorsRepository
     */
    public function __construct(OnlineVisitorsRepository $visitorsRepository)
    {
        $this->visitorsRepository = $visitorsRepository;
    }

    /**
     * @return int
     */
    public function getOnlineUsersCount(): int
    {
        $endTime   = Carbon::now();
        $startTime = $endTime->subSeconds($this->onlineMarginInSecond);

        return $this->visitorsRepository->getVisitorCount($this->visitorKey(), $startTime->getTimestamp(), $endTime->getTimestamp());
    }

    /**
     * @return int
     */
    public function getOnlineVisitorsCount(): int
    {
        return 1234;
    }

    /**
     * @return string
     */
    private function visitorKey(): string
    {
        return $this->prepareKey('visitors');
    }

    /**
     * @param string $key
     *
     * @return string
     */
    private function prepareKey(string $key): string
    {
        return sprintf("%s%s", $this->keyPrefix, $key);
    }
}
