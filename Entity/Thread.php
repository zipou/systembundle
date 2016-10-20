<?php

namespace box4b\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"symfony" = "box4b\SystemBundle\Entity\SymfonyThread", "thread" = "box4b\SystemBundle\Entity\Thread"})* 
 */
class Thread {

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue * */
    private $id;
    protected $command;

    /** @ORM\Column(type="string") */
    private $PID;

    /** @ORM\Column(type="boolean") */
    private $active = false;

    /** @ORM\Column(type="boolean", nullable=true) */
    private $respawn = false;

    /** @ORM\Column(type="string", name="thread_desc",  nullable=true) */
    private $desc;

    /** @ORM\Column(type="datetime", nullable=true) */
    private $startDate;

    /** @ORM\Column(type="datetime", nullable=true) */
    private $endDate;

    /** @ORM\Column(type="string", nullable=true) */
    private $hostname;

    function getHostname() {
        return $this->hostname;
    }

    function setHostname($hostname) {
        $this->hostname = $hostname;
    }

    function getRespawn() {
        return $this->respawn;
    }

    function setRespawn($respawn) {
        $this->respawn = $respawn;
    }

    function getEndDate() {
        return $this->endDate;
    }

    function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    function getStartDate() {
        return $this->startDate;
    }

    function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    function getDesc() {
        return $this->desc;
    }

    function setDesc($desc) {
        $this->desc = $desc;
    }

    public function __construct($command) {
        $this->command = $command;
        ;
    }

    function getId() {
        return $this->id;
    }

    function getActive() {
        return $this->active;
    }

    function setActive($active) {
        $this->active = $active;
    }

    function getCommand() {
        return $this->command;
    }

    function getPID() {
        return $this->PID;
    }

    function setPID($PID) {
        $this->PID = $PID;
    }

    public function __toString() {
        return $this->getPID();
    }

    public static function getGenericFields() {
        return array("PID" => "PID", "hostname" => "hostname", "desc" => "desc", "active" => "active", "startDate" => "startDate", "endDate" => "endDate");
    }

    public static function getGenericFilters() {
        return array("startDate" => "datetime", "endDate" => "datetime");
    }

}
