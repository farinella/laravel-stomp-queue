<?php

namespace tochkaDevelopers\laravelStompQueue\Jobs;

use Illuminate\Queue\Jobs\Job;
use Illuminate\Contracts\Queue\Job as JobContract;
use tochkaDevelopers\laravelStompQueue\StompQueue;
use Illuminate\Container\Container;

class StompJob extends Job implements JobContract
{
    /**
     * @var StompQueue
     */
    private $stomp;
    /**
     * @var
     */
    private $job;


    /**
     * StompJob constructor.
     * @param \Illuminate\Container\Container $container
     * @param StompQueue $stomp
     * @param $job
     */
    public function __construct(Container $container, StompQueue $stomp, $job)
    {

        $this->container = $container;
        $this->stomp = $stomp;
        $this->job = $job;
    }

    /**
     * Fire the job.
     *
     * @return void
     */
    public function fire()
    {
        // TODO: Implement fire() method.
    }

    /**
     * Get the number of times the job has been attempted.
     *
     * @return int
     */
    public function attempts()
    {
        // TODO: Implement attempts() method.
    }

    /**
     * Get the raw body string for the job.
     *
     * @return string
     */
    public function getRawBody()
    {
        return $this->job->body;
    }
}