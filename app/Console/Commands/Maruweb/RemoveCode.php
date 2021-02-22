<?php

namespace App\Console\Commands\Maruweb;

use Illuminate\Console\Command;

class RemoveCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maruweb:remove-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[MARUWEB] Remove code';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('THIS IS LARAVEL REMOVE CODE TOOL!');
        $this->info('This tool helps you remove model, controller, service, request, config, observer, factory, seeder, view files quickly!');

        $singular = $this->ask('Enter singular');
        $plural = $this->ask('Enter plural');

        // 1/ model
        if (file_exists("app/Models/".ucfirst($singular).".php")) {
            unlink("app/Models/".ucfirst($singular).".php");

            echo "Delete model successfully\n";
        }

        // 2/ controller
        if (file_exists("app/Http/Controllers/Admin/".ucfirst($singular)."Controller.php")) {
            unlink("app/Http/Controllers/Admin/".ucfirst($singular)."Controller.php");

            echo "Delete controller successfully\n";
        }

        // 3/ service
        if (file_exists("app/Services/".ucfirst($singular)."Service.php")) {
            unlink("app/Services/".ucfirst($singular)."Service.php");

            echo "Delete service successfully\n";
        }

        // 4/ requests
        if (file_exists("app/Http/Requests/".ucfirst($singular)."/Store".ucfirst($singular)."Request.php")) {
            unlink("app/Http/Requests/".ucfirst($singular)."/Store".ucfirst($singular)."Request.php");

            echo "Delete store request successfully\n";
        }
        if (file_exists("app/Http/Requests/".ucfirst($singular)."/Update".ucfirst($singular)."Request.php")) {
            unlink("app/Http/Requests/".ucfirst($singular)."/Update".ucfirst($singular)."Request.php");

            echo "Delete update request successfully\n";
        }

        // 5/ config
        if (file_exists("config/constants/".$singular.".php")) {
            unlink("config/constants/".$singular.".php");

            echo "Delete config successfully\n";
        }

        // 6/ observer
        if (file_exists("app/Observers/".ucfirst($singular)."Observer.php")) {
            unlink("app/Observers/".ucfirst($singular)."Observer.php");

            echo "Delete observer successfully\n";
        }

        // 7/ factory
        if (file_exists("database/factories/".ucfirst($singular)."Factory.php")) {
            unlink("database/factories/".ucfirst($singular)."Factory.php");

            echo "Delete factory successfully\n";
        }

        // 8/ seed
        if (file_exists("database/seeders/".ucfirst($singular)."TableSeeder.php")) {
            unlink("database/seeders/".ucfirst($singular)."TableSeeder.php");

            echo "Delete seed successfully\n";
        }

        // 9/ views
        if (file_exists("resources/views/admin/".$plural."/index.blade.php")) {
            unlink("resources/views/admin/".$plural."/index.blade.php");

            echo "Delete index view successfully\n";
        }
        if (file_exists("resources/views/admin/".$plural."/create.blade.php")) {
            unlink("resources/views/admin/".$plural."/create.blade.php");

            echo "Delete create view successfully\n";
        }
        if (file_exists("resources/views/admin/".$plural."/edit.blade.php")) {
            unlink("resources/views/admin/".$plural."/edit.blade.php");

            echo "Delete edit view successfully\n";
        }
    }
}
