<?php

namespace box4b\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SymfonyThread extends \box4b\SystemBundle\Entity\Thread {

    private $arguments = null;
    private $root;

    public function __construct($command) {
        parent::__construct($command);
    }

    function getRoot() {
        return $this->root;
    }

    function setRoot($root) {
        $this->root = $root;
    }

    function getArguments() {
        return $this->arguments;
    }

    function setArguments(array $arguments) {
        $this->arguments = $arguments;
    }

    public function getCommand() {
        return ($this->arguments == null) ? sprintf("/usr/bin/php %s/console %s", $this->getRoot(), $this->command) : sprintf("/usr/bin/php %s/console %s %s", $this->getRoot(), $this->command, implode(" ", $this->getArguments()));
    }

}
