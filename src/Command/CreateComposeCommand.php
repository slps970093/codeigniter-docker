<?php

namespace Cidocker\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class CreateComposeCommand extends Command
{
    protected function configure()
    {
        $this->setDescription('Create Codeigniter Docker Compose File')
            ->addArgument('ci-ver', InputArgument::REQUIRED, "codeigniter version");
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $codeigniterVer = $input->getArgument("ci-ver");

        if (!in_array($codeigniterVer, [3,4])) {
            return $output
                ->write("your codeigniter version wrong version，Only version 3 or 4 is supported");
        }

        $fileSystem = new Filesystem();

        $fileSystem->mirror("./vendor/slps970093/codeigniter-docker/runtimes/ci-{$codeigniterVer}/","./");

        $output->write('success');
    }
}