<?php

namespace RealSoft\SAPBOSL\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallSAPBOSLPackage extends Command
{
    protected $signature = 'sap:install';

    protected $description = 'Install the SAPBOSL';

    public function handle()
    {
        $this->info('Installing SAPBOSL...');

        $this->info('Publishing configuration...');

        if (! $this->configExists('sap.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed SAPBOSL');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "RealSoft\SAPBOSL\SAPBOSLServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

       $this->call('vendor:publish', $params);
    }
}