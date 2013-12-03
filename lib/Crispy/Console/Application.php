<?php

namespace Crispy\Console;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication {

    protected function getDefaultCommands() {

        $commands = parent::getDefaultCommands();
        $commands[] = new BuildCommand(); 

        return $commands;

    }

}
