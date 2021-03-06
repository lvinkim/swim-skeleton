<?php
/**
 * Created by PhpStorm.
 * User: lvinkim
 * Date: 2018/8/14
 * Time: 9:45 PM
 */

namespace App\Command;


use Lvinkim\SwimKernel\Component\Command;
use Lvinkim\SwimKernel\Service\SwimKernelLogger;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IamAliveCommand extends Command
{
    protected function configure()
    {
        $this->setName('app:alive')
            ->setDescription('上报心跳');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var SwimKernelLogger $logger */
        $logger = $this->container[SwimKernelLogger::class];

        $logger->visionWatch('command', 'i-am-alive', 1);
    }

}