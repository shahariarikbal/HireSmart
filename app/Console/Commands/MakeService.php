<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new Service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $serviceClass = ucfirst($name);
        $directory = app_path("Services");

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $path = $directory . "/{$serviceClass}.php";

        if (File::exists($path)) {
            $this->error("Service class {$serviceClass} already exists!");
            return;
        }

        $stub = <<<PHP
    <?php

    namespace App\Services;

    class {$serviceClass}
    {
        public function __construct()
        {
            // Constructor logic here
        }

        // Add your service methods here
    }

    PHP;

        File::put($path, $stub);
        $this->info("Service class {$serviceClass} created successfully at {$path}");
        $this->info("Don't forget to register your service in the service provider if needed.");
        $this->info("You can now use the service in your application.");
    }

}
