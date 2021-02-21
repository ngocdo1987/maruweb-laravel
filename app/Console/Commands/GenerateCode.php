<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maruweb:generate-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[MARUWEB] Generate code';

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
        $this->info('THIS IS LARAVEL GENERATE CODE TOOL!');

        $singular = $this->ask('Enter singular: ');
        $plural = $this->ask('Enter plural: ');

        $findArr = ['Dummies', 'Dummy', 'dummies', 'dummy'];
        $replaceArr = [
            ucfirst($plural),
            ucfirst($singular),
            $plural,
            $singular
        ];

        // 1/ Generate model
        $model = file_get_contents("stubs/maruweb/model/Dummy.stub");
        $model = str_replace($findArr, $replaceArr, $model);
        file_put_contents("app/Models/".ucfirst($singular).".php", $model);
        echo "Generate model successfully!\n";

        // 2/ Generate controller
        $controller = file_get_contents("stubs/maruweb/controller/DummyController.stub");
        $controller = str_replace($findArr, $replaceArr, $controller);
        file_put_contents("app/Http/Controllers/Admin/".ucfirst($singular)."Controller.php", $controller);
        echo "Generate controller successfully!\n";

        // 3/ Generate service
        $service = file_get_contents("stubs/maruweb/service/DummyService.stub");
        $service = str_replace($findArr, $replaceArr, $service);
        file_put_contents("app/Services/".ucfirst($singular)."Service.php", $service);
        echo "Generate service successfully!\n";

        // 4/ Generate requests
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

        // 5/ Generate config
        $config = file_get_contents("stubs/maruweb/config/dummy.stub");
        file_put_contents("config/constants/".$singular.".php", $config);
        echo "Generate config successfully!\n";

        // 6/ Generate observer
        $observer = file_get_contents("stubs/maruweb/observer/DummyObserver.stub");
        $observer = str_replace($findArr, $replaceArr, $observer);
        file_put_contents("app/Observers/".ucfirst($singular)."Observer.php", $observer);
        echo "Generate observer successfully!\n";

        // 7/ Generte factory
        $factory = file_get_contents("stubs/maruweb/factory/DummyFactory.stub");
        $factory = str_replace($findArr, $replaceArr, $factory);
        file_put_contents("database/factories/".ucfirst($singular)."Factory.php", $factory);
        echo "Generate factory successfully!\n";

        // 8/ Generate seed
        $seed = file_get_contents("stubs/maruweb/seed/DummyTableSeeder.stub");
        $seed = str_replace($findArr, $replaceArr, $seed);
        file_put_contents("database/seeders/".ucfirst($singular)."TableSeeder.php", $factory);
        echo "Generate seed successfully!\n";

        // 9/ Generate views
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

        // echo "Successfully!";
    }
}
