<?php

namespace box4b\SystemBundle\Services;

class CronService {

    const MINUTE = "00";
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

        $event = new \box4b\SystemBundle\Event\CronEvent();

        if (true) {
            //Launch EveryMinute Job
            $this->eventListener->dispatch(\box4b\SystemBundle\Event\CronEvent::EVERY_MINUTE, $event);
        }

        if (($minute % 5) == 0) {
            //Launch EveryFive Minute Job
            $this->eventListener->dispatch(\box4b\SystemBundle\Event\CronEvent::EVERY_FIVE_MINUTES, $event);
        }

        if (($minute % 15) == 0) {
            //Launch EVERY_FIFTEEN_MINUTES Job
            $this->eventListener->dispatch(\box4b\SystemBundle\Event\CronEvent::EVERY_FIFTEEN_MINUTES, $event);
        }

        if (($minute % 30) == 0) {
            //Launch EVERY_HALF_HOUR Job
            $this->eventListener->dispatch(\box4b\SystemBundle\Event\CronEvent::EVERY_HALF_HOUR, $event);
        }

        if ($minute == self::MINUTE) {
            //Launch EveryHour Job
            $this->runHourly();
        }

        if (($minute == self::MINUTE) && ($hour % 2 == 0)) {
            //Launch Every 2 Hours Job
            $this->eventListener->dispatch(\box4b\SystemBundle\Event\CronEvent::EVERY_TWO_HOURS, $event);
        }

        if ($minute == self::MINUTE && $hour == self::HOUR) {
            //Launch EveryDay Jobs
            $this->runDaily();
        }

        if ($minute == self::MINUTE && $hour == self::HOUR && $day == self::DAY) {
            //Launch Weekly Jobs
            $this->eventListener->dispatch(\box4b\SystemBundle\Event\CronEvent::EVERY_WEEK, $event);
        }
    }

    public function runDaily() {
        //Launch EveryDay Jobs
        $event = new \box4b\SystemBundle\Event\CronEvent();
        $this->eventListener->dispatch(\box4b\SystemBundle\Event\CronEvent::EVERY_DAY, $event);
    }

    public function runHourly() {
        $event = new \box4b\SystemBundle\Event\CronEvent();
        $this->eventListener->dispatch(\box4b\SystemBundle\Event\CronEvent::EVERY_HOUR, $event);
    }

}
