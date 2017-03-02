<?php

namespace box4b\SystemBundle\Services;

class StatsService {

    private $logger;
    private $env;

    public function __construct($logger, $env) {
        $this->logger = $logger;
        $this->env = $env;
    }

    public function getLoadInfo() {
      return sys_getloadavg()[0];
    }

    public function getRamInfo() {
      $info = $this->parseMemInfo();
      return $info["MemAvailable"];
    }

    public function getDiskSpace($path = "/") {
      return disk_free_space($path);
    }

    private function parseMemInfo() {
      $filename = ($this-> env == "dev") ? __DIR__ . "/../Resources/samples/meminfo" : "/proc/meminfo";
      $fileArray = explode("\n", file_get_contents($filename));
      $stats = [];
      foreach($fileArray as $line) {
        $result = explode(":", $line);
        if (count($result) > 1) {
          $stats[$result[0]] = str_replace([" ", "kB"],["",""], $result[1]);
        }
      }
      return $stats;
    }

}
