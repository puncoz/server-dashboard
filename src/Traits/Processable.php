<?php

namespace Puncoz\ServerDashboard\Traits;

use Symfony\Component\Process\Process;

/**
 * Trait Processable
 * @package Puncoz\ServerDashboard\Traits
 */
trait Processable
{
    /**
     * Run Server .sh (shell) Process
     *
     * @param string $command
     * @param string $cwd
     *
     * @return mixed
     * @throws \Exception
     */
    private function runProcess($command = 'ls', $cwd = null)
    {
        $processOutput = collect();
        $process       = new Process($command);
        $process->setWorkingDirectory(($cwd ? $cwd : base_path()));
        $process->setIdleTimeout(10);
        $process->setTimeout(15);
        try {
            $process->run(
                function ($type, $buffer) use (&$processOutput, &$process) {
                    $processOutput->push($buffer);
                    if ( Process::ERR === $type ) {
                        //Handle Error
                        throw new \Exception('Whoopsie!');
                    }
                }
            );
            //$process->getPid(); //Get PID if needed
        } catch (\Exception $exception) {
            throw $exception;
        }

        return $processOutput;
    }
}
