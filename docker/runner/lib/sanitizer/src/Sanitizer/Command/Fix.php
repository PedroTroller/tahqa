<?php

namespace Sanitizer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sanitizer\Compose;
use Symfony\Component\Console\Input\InputArgument;

class Fix extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('fix')
            ->setDescription('Fix the given docker-compose Yaml file.')
            ->addArgument('file', InputArgument::REQUIRED, 'The Yaml file')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fixer = new Compose();

        $fixer->fix(realpath($input->getArgument('file')));
    }
}
