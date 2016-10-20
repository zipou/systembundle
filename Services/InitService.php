<?php

namespace box4b\SystemBundle\Services;

use box4b\SystemBundle\Event\InitEvent;

class InitService {

    const INIT_START = "start";
    const INIT_STOP = "stop";

    private $logger;
    private $event_dispatcher;

    public function __construct($logger, $event) {
        $this->logger = $logger;
        $this->event_dispatcher = $event;
    }

    public function init($runlevel) {
        switch ($runlevel) {
            case self::INIT_START:
                $this->start();
                break;

            case self::INIT_STOP:
                $this->stop();
                break;
        }
    }

    private function start() {
        $event = new InitEvent();
        $this->event_dispatcher->dispatch(InitEvent::EVENT_START, $event);
    }

    private function stop() {
        $event = new InitEvent();
        $this->event_dispatcher->dispatch(InitEvent::EVENT_STOP, $event);
    }

}
