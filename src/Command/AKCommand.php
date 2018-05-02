<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-5-2
 * Time: 上午9:40
 */

namespace Monkey\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AKCommand extends Command
{
    protected function configure()
    {
        $this->setName('ak:generate')
            ->setDescription('generate access_key and secret_key')
            ->setHelp('bin/console ak:generate');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        return;
    }
}