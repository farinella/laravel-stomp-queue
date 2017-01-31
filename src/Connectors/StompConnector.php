<?php

namespace tochkaDevelopers\laravelStompQueue\Connectors;

use Illuminate\Queue\Connectors\ConnectorInterface;
use tochkaDevelopers\laravelStompQueue\StompQueue;

class StompConnector implements ConnectorInterface
{

    /**
     * Establish a queue connection.
     *
     * @param  array $config
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        foreach (explode(';', $config['urls']) as $host) {
            if ($connection = $this->_connect($host, $config)) {
                return new StompQueue($connection, $config['queue']);
            }
        }
    }

    /**
     * @param string $host
     * @param array $config
     * @return Stomp
     */
    private function _connect($host = '', array $config)
    {
        return new \Stomp($host, $config['login'], $config['pass']);
    }

}