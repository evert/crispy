<?php

namespace Crispy\Console;

use
    Symfony\Component\Console\Command\Command,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface;

class BuildCommand extends Command {

    protected function configure() {

        $this->setName('build');
        $this->setDescription('Builds the static site');

    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        
        $defaultConfig = [
            "ignore" => [
                ".*",
                "_*"
            ],
            "source" => getcwd(),
            "destination" => getcwd() . "/_site",
        ];

        $builder = new \Crispy\Builder();
        $builder->setConfig($defaultConfig);

        $builder->buildAll();

    }

}
