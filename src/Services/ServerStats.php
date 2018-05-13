<?php

namespace Puncoz\ServerDashboard\Services;

use Carbon\Carbon;
use Puncoz\ServerDashboard\Traits\Processable;

/**
 * Class ServerStats
 * @package Puncoz\ServerDashboard\Services
 */
class ServerStats
{
    use Processable;

    /**
     * @return string
     */
    public function getMemoryUsage(): string
    {
        $memory = $this->getServerMemory();

        return sprintf("%s%%", $memory);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getCpuUsages(): string
    {
        $cpu = $this->runProcess("grep 'cpu ' /proc/stat | awk '{usage=($2+$4)*100/($2+$4+$5)} END {print usage \"%\"}'")->first();

        return trim($cpu);
    }

    /**
     * @return Carbon
     */
    public function getServerDateTime(): Carbon
    {
        return Carbon::now();
    }

    /**
     * @return float
     */
    protected function getServerMemory(): float
    {
        $free         = shell_exec('free');
        $free         = (string) trim($free);
        $free_arr     = explode("\n", $free);
        $mem          = explode(" ", $free_arr[1]);
        $mem          = array_filter($mem);
        $mem          = array_merge($mem);
        $memory_usage = (float) $mem[2] / (float) $mem[1] * 100;

        return round($memory_usage, 2);
    }
}
