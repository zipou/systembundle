<?php

namespace Technical\SystemBundle\Services;

class CronService {

    const MINUTE = "25";
    const HOUR = "2";
    const DAY = "0";

    private $logger;
    private $eventListener;
    private $launchedTime;

    public function __construct($logger, $event) {
        $this->eventListener = $event;
        $this->logger = $logger;
    }

    public function run() {

        //First set Time of Launch
        $this->launchedTime = new \DateTime();

        $hour = $this->launchedTime->format("G");
        $minute = $this->launchedTime->format("i");
        $day = $this->launchedTime->format("w");

        $event = new \Technical\SystemBundle\Event\CronEvent();

        if (true) {
            //Launch EveryMinute Job
            $this->eventListener->dispatch(\Technical\SystemBundle\Event\CronEvent::EVERY_MINUTE, $event);
        }

        if (($minute % 5) == 0) {
            //Launch EveryFive Minute Job
            $this->eventListener->dispatch(\Technical\SystemBundle\Event\CronEvent::EVERY_FIVE_MINUTES, $event);
        }

        if ($minute == self::MINUTE) {
            //Launch EveryHour Job
            $this->eventListener->dispatch(\Technical\SystemBundle\Event\CronEvent::EVERY_HOUR, $event);
        }
        if ($minute == self::MINUTE && $hour == self::HOUR) {
            //Launch EveryDay Jobs
            $this->runDaily();
        }
        if ($minute == self::MINUTE && $hour == self::HOUR && $day == self::DAY) {
            //Launch Weekly Jobs
            $this->eventListener->dispatch(\Technical\SystemBundle\Event\CronEvent::EVERY_WEEK, $event);
        }
    }

    public function runDaily() {
        //Launch EveryDay Jobs
        $event = new \Technical\SystemBundle\Event\CronEvent();
        $this->eventListener->dispatch(\Technical\SystemBundle\Event\CronEvent::EVERY_DAY, $event);
    }

}
