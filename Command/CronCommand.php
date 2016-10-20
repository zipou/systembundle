<?php

namespace Technical\SystemBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CronCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('cron:launch')
                ->setDescription('Every Minute Cron')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $service = $this->getContainer()->get('zipou_system.cronservice');
        $service->run();
    }

}
