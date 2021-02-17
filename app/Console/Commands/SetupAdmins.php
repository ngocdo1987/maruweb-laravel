<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Str;

class SetupAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maruweb:setup-admins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[MARUWEB] Setup admins';

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
        $admins = [
            'Maruweb dev' => 'dev@maruweb.vn',
            'Maruweb admin' => 'admin@maruweb.vn',
            'Maruweb content admin' => 'contentadmin@maruweb.vn',
            'Maruweb user admin' => 'useradmin@maruweb.vn'
        ];

        foreach ($admins as $k => $v) {
            Admin::create([
                'name' => $k,
                'email' => $v,
                'password' => bcrypt('Qwe123!@#'),
                'remember_token' => Str::random(10)
            ]);
        }

        echo "Setup admins successfully!\n";
    }
}
