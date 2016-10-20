<?php

namespace box4b\SystemBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class InitEvent extends Event {

    const EVENT_START = "init.start";
    const EVENT_STOP = "init.stop";

}
