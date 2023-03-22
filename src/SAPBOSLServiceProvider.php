<?php

namespace RealSoft\SAPBOSL;

use Illuminate\Support\ServiceProvider;
use RealSoft\SAPBOSL\Console\InstallSAPBOSLPackage;

class SAPBOSLServiceProvider extends ServiceProvider
{
  public function register()
  {
    
    if (file_exists(config_path('sap.php'))) {
        $this->mergeConfigFrom(config_path('sap.php'), 'sap');
    } else {
        $this->mergeConfigFrom(__DIR__ . '/../config/sap.php', 'sap');
    }
  }

  public function boot()
  {
    if ($this->app->runningInConsole()) {

        $this->commands([
            InstallSAPBOSLPackage::class,
        ]);

        $this->publishes([
          __DIR__ . '/../config/sap.php' => config_path('sap.php'),
      ], 'sap');

    }
  }
}