<?php

namespace box4b\SystemBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('box4b:init')
                ->setDescription('Init')
                ->addArgument('status', InputArgument::REQUIRED, '')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $service = $this->getContainer()->get('zipou_system.initservice');
        $status = $input->getArgument('status');
        $service->init($status);
    }

}
