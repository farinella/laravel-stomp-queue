<?php

namespace tochkaDevelopers\laravelStompQueue;

use Illuminate\Contracts\Queue\Queue as QueueContract;
use Illuminate\Queue\Queue;

class StompQueue extends Queue implements QueueContract
{

    /**
     * @var Stomp
     */
    private $stomp;
    /**
     * @var string
     */
    private $default;

    /**
     * StompQueue constructor.
     * @param \Stomp $stomp
     * @param string $default
     */
    public function __construct(\Stomp $stomp, $default = 'default')
    {
        $this->stomp = $stomp;
        $this->default = $default;
    }

    /**
     * Push a new job onto the queue.
     *
     * @param  string $job
     * @param  mixed $data
     * @param  string $queue
     * @return mixed
     */
    public function push($job, $data = '', $queue = null)
    {
        return $this->pushRaw($this->createPayload($job, $data), $queue);
    }

    /**
     * Push a raw payload onto the queue.
     *
     * @param  string $payload
     * @param  string $queue
     * @param  array $options
     * @return mixed
     */
    public function pushRaw($payload, $queue = null, array $options = [])
    {
        return $this->stomp->send($this->getQueue($queue), $payload, $options);
    }

    /**
     * Push a new job onto the queue after a delay.
     *
     * @param  \DateTime|int $delay
     * @param  string $job
     * @param  mixed $data
     * @param  string $queue
     * @return mixed
     */
    public function later($delay, $job, $data = '', $queue = null)
    {
        // TODO: Implement later() method.
    }

    /**
     * Pop the next job off of the queue.
     *
     * @param  string $queue
     * @return \Illuminate\Contracts\Queue\Job|null
     */
    public function pop($queue = null)
    {
        $this->stomp->subscribe($this->getQueue($queue));

        if (!$this->stomp->hasFrame()) {
            return;
        }

        $job = $this->stomp->readFrame();

        if (!empty($job) && ($job instanceof StompFrame)) {
            return new StompJob($this->container, $this, $job);
        }
    }

    /**
     * Get the queue or return the default.
     *
     * @param  string|null  $queue
     * @return string
     */
    public function getQueue($queue)
    {
        return $queue ?: $this->default;
    }
}