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
    protected $onlineMarginInSecond;
    /**
     * @var OnlineVisitorsRepository
     */
    protected $visitorsRepository;
    /**
     * @var string
     */
    protected $keyPrefix;

    /**
     * OnlineCounter constructor.
     *
     * @param OnlineVisitorsRepository $visitorsRepository
     */
    public function __construct(OnlineVisitorsRepository $visitorsRepository)
    {
        $this->visitorsRepository = $visitorsRepository;

        $this->onlineMarginInSecond = config('server-dashboard.online_user_counter_margin');
        $this->keyPrefix            = lrtrim(config('server-dashboard.prefix'), ':');
    }

    /**
     * @return int
     */
    public function getOnlineUsersCount(): int
    {
        $now = Carbon::now();

        return $this->visitorsRepository->getVisitorCount($this->userKey(), $now->getTimestamp(), $now->subSeconds($this->onlineMarginInSecond)->getTimestamp());
    }

    /**
     * @return int
     */
    public function getOnlineVisitorsCount(): int
    {
        $now = Carbon::now();

        return $this->visitorsRepository->getVisitorCount($this->visitorKey(), $now->getTimestamp(), $now->subSeconds($this->onlineMarginInSecond)->getTimestamp());
    }

    /**
     * @param string $sessionCode
     */
    public function logGuestUser(string $sessionCode)
    {
        $time = Carbon::now()->getTimestamp();

        $this->visitorsRepository->setVisitorLog($this->visitorKey(), $time, $sessionCode);
    }

    /**
     * @param string $sessionCode
     */
    public function logAuthenticUser(string $sessionCode)
    {
        $time = Carbon::now()->getTimestamp();

        $this->visitorsRepository->setVisitorLog($this->userKey(), $time, $sessionCode);
    }

    /**
     * @return string
     */
    private function visitorKey(): string
    {
        return $this->prepareKey('visitors');
    }

    /**
     * @return string
     */
    private function userKey(): string
    {
        return $this->prepareKey('users');
    }

    /**
     * @param string $key
     *
     * @return string
     */
    private function prepareKey(string $key): string
    {
        return sprintf("%s:online:%s", $this->keyPrefix, $key);
    }
}
