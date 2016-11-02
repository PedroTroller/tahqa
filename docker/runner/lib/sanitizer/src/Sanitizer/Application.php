<?php

namespace Sanitizer;

use Sanitizer\Command\Fix;

use Symfony\Component\Console\Application as ConsoleApplication;

class Application extends ConsoleApplication
{
    protected function getDefaultCommands()
    {
        return array_merge(parent::getDefaultCommands(), [new Fix()]);
    }
}
