<?php

namespace Technical\SystemBundle\Services;

class MemcacheService {

    private $server;
    private $port;
    private $timeout;
    private $memcache;

    public function __construct($server = "localhost", $port = 11211, $timeout = 0) {
        $this->server = $server;
        $this->port = $port;
        $this->timeout = $timeout;
        $this->init();
    }

    public function init() {
        $memcache = new \Memcache();
        $memcache->connect($this->server, $this->port);
        $this->memcache = $memcache;
    }

    public function setTimeout($int) {
        $this -> timeout = $int;
    }
    
    public function getMemcache() {
        return $this->memcache;
    }

    public function get($key) {
        return $this->memcache->get($key);
    }
    
    public function set($key, $value, $timeout = null) {
        if ($timeout == null)
            $timeout = $this->timeout;
        return $this->memcache->set($key, $value, $timeout);
    }

}
