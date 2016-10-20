<?php

namespace box4b\SystemBundle\Services;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ThreadService implements EventSubscriberInterface {

    private $logger;
    private $doctrine;
    private $root_dir;

    public function __construct($logger, $doctrine, $rootdir) {
        $this->logger = $logger;
        $this->doctrine = $doctrine;
        $this->root_dir = $rootdir;
    }

    static public function getSubscribedEvents() {
        return array(
            // \box4b\SystemBundle\Event\CronEvent::EVERY_MINUTE => array('updateStatus', 0)
        );
    }

    public function runThread(\box4b\SystemBundle\Entity\Thread $thread) {
        if ($thread instanceof \box4b\SystemBundle\Entity\SymfonyThread) {
            $thread->setRoot($this->root_dir);
        }
        if ($thread->getRespawn()) {
            $cmd = sprintf("sh -c 'while true; do %s; sleep 2; done'", $thread->getCommand());
        } else {
            $cmd = $thread->getCommand();
        }

        $thread->setHostname(gethostname());
        $command = sprintf("nohup %s > /dev/null & echo $!", $cmd);

        $this->logger->debug("Running thread with command " . $command);
        $PID = shell_exec($command);
        $thread->setPID($PID);
        $thread->setActive(true);
        $thread->setStartDate(new \DateTime());
        $this->logger->debug('PID is ' . $PID);
        $em = $this->doctrine->getManager();
        $em->persist($thread);
        $em->flush();
        $this->logger->debug("Stop Running thread with command " . $command);
    }

    public function updateStatus(\box4b\SystemBundle\Event\CronEvent $event) {
//        $this->logger->debug("Updating Status of Thread");
        $em = $this->doctrine->getManager();
        $repo = $em->getRepository("SystemBundle:Thread");
        foreach ($repo->findBy(array("active" => true)) as $thread) {
            if (!$this->isRunning($thread->getPID())) {
                $thread->setActive(false);
                $thread->setEndDate(new \DateTime());
                $em->persist($thread);
            }
        }
//        $this->logger->debug("Stop Updating Thread status");

        $em->flush();
    }

    public function isRunning($PID) {
        exec("ps $PID", $ProcessState);
        return(count($ProcessState) >= 2);
    }

}
