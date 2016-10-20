<?php

namespace zipou\MyboxConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Config_Daemon")
 */
class Daemon {


    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue * */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Role", inversedBy="daemons") */
    private $role;
    
    /** @ORM\OneToMany(targetEntity="ConfigFile", mappedBy="daemon", cascade={"persist"}, orphanRemoval=true) */
    private $configFiles;
    
    /** @ORM\Column(type="string") */
    private $name;

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function __construct(Role $role) {
        $this->role = $role;
    }

    public function setConfigFiles(array $conf) {
        $this->configFiles = $conf;
    }

    public function getConfigFiles() {
        return $this->configFiles;
    }

}
