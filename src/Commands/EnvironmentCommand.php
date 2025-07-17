<?php

namespace Hanafalah\ModuleProfession\Commands;

use Hanafalah\LaravelSupport\{
    Commands\BaseCommand
};
use Hanafalah\LaravelSupport\Concerns\ServiceProvider\HasMigrationConfiguration;

class EnvironmentCommand extends BaseCommand
{
    use HasMigrationConfiguration;

    protected function init(): self
    {
        //INITIALIZE SECTION
        $this->setLocalConfig('module-profession');
        return $this;
    }

    protected function dir(): string
    {
        return __DIR__ . '/../';
    }
}
