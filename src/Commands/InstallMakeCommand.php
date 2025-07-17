<?php

namespace Hanafalah\ModuleProfession\Commands;

class InstallMakeCommand extends EnvironmentCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module-profession:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command ini digunakan untuk installing awal module profession';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $provider = 'Hanafalah\ModuleProfession\ModuleProfessionServiceProvider';

        $this->comment('Installing Module Profession...');
        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'config'
        ]);
        $this->info('✔️  Created config/module-profession.php');

        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'migrations'
        ]);
        $this->info('✔️  Created migrations');

        $this->comment('hanafalah/module-profession installed successfully.');
    }
}
