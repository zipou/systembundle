<?php

namespace box4b\SystemBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class CronEvent extends Event {

    const EVERY_MINUTE = "cron.minute";
    const EVERY_FIVE_MINUTES = "cron.five_minute";
    const EVERY_FIFTEEN_MINUTES = "cron.fifteen_minute";
    const EVERY_HALF_HOUR = "cron.half_hour";
    const EVERY_HOUR = "cron.hour";
    const EVERY_DAY = "cron.day";
    const EVERY_WEEK = "cron.week";

    private $datetime;

    public function __construct() {
        $this -> datetime = new \DateTime();
    }

    public function getDateTime() {
        return $this -> datetime;
    }

}
