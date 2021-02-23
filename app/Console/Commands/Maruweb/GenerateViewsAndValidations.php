<?php

namespace App\Console\Commands\Maruweb;

use Illuminate\Console\Command;

class GenerateViewsAndValidations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maruweb:generate-views-and-validations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[MARUWEB] Generate views and validations';

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
        $this->info('THIS IS LARAVEL GENERATE VIEWS AND VALIDATIONS TOOL!');
        $this->info('This tool helps you generate views and validations quickly!');

        $singular = $this->ask('Enter singular');
        $plural = $this->ask('Enter plural');

        $findArr = ['Dummies', 'Dummy', 'dummies', 'dummy'];
        $replaceArr = [
            ucfirst($plural),
            ucfirst($singular),
            $plural,
            $singular
        ];

        // List all columns in table
        

        /*
        // 1/ Generate requests
        $storeRequest = file_get_contents("stubs/maruweb/requests/StoreDummyRequest.stub");
        $storeRequest = str_replace($findArr, $replaceArr, $storeRequest);
        $updateRequest = file_get_contents("stubs/maruweb/requests/UpdateDummyRequest.stub");
        $updateRequest = str_replace($findArr, $replaceArr, $updateRequest);
        if (!is_dir("app/Http/Requests/".ucfirst($singular))) {
            mkdir("app/Http/Requests/".ucfirst($singular));
        }
        file_put_contents("app/Http/Requests/".ucfirst($singular)."/Store".ucfirst($singular)."Request.php", $storeRequest);
        file_put_contents("app/Http/Requests/".ucfirst($singular)."/Update".ucfirst($singular)."Request.php", $updateRequest);
        echo "Generate requests successfully!\n";

        // 2/ Generate views
        $index = file_get_contents("stubs/maruweb/views/index.blade.stub");
        $index = str_replace($findArr, $replaceArr, $index);
        $create = file_get_contents("stubs/maruweb/views/create.blade.stub");
        $create = str_replace($findArr, $replaceArr, $create);
        $edit = file_get_contents("stubs/maruweb/views/edit.blade.stub");
        $edit = str_replace($findArr, $replaceArr, $edit);
        if (!is_dir("resources/views/admin/".$plural)) {
            mkdir("resources/views/admin/".$plural);
        }
        file_put_contents("resources/views/admin/".$plural."/index.blade.php", $index);
        file_put_contents("resources/views/admin/".$plural."/create.blade.php", $create);
        file_put_contents("resources/views/admin/".$plural."/edit.blade.php", $edit);
        echo "Generate views successfully!\n";
        */

        // 10/ Export

        // 11/ Import

        // echo "Successfully!";
    }
}
