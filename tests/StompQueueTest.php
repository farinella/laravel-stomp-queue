<?php

namespace tochkaDevelopers\laravelStompQueue;

use PHPUnit\Framework\TestCase;
use tochkaDevelopers\laravelStompQueue\Connectors\StompConnector;
//use Illuminate\Queue\Capsule\Manager as Queue;

class StompQueueTest extends TestCase
{

    public static $config = [
        'urls' => 'tcp://127.0.0.1:61613',
        'login' => '',
        'pass' => '',
        'queue' => 'test'
    ];
    protected $queue;

    protected function setUp()
    {
        $this->queue = (new StompConnector())->connect(self::$config);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     *
     */
    public function testPush()
    {
        $job = 'job';
        $data = 'data';
//        $queue = 'test';
//        $expected = json_encode(['job' => $job, 'data' => $data]);

        $this->assertTrue($this->queue->push($job, $data));
    }

}