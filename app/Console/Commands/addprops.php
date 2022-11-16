<?php

namespace App\Console\Commands;

//use App\Http\Resources\PageResources\Testresource;
use App\Http\Resources\Testresource;
use Illuminate\Console\Command;

class addprops extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:addprops';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    function classes_in_namespace($namespace) {
        $namespace .= '\\';

        $myClasses  = array_filter(get_declared_classes(),
            function($item) use ($namespace) {
            return substr($item, 0, strlen($namespace)) === $namespace;
        });
        $theClasses = [];
        foreach ($myClasses AS $class):
            $theParts = explode('\\', $class);
            $theClasses[] = end($theParts);
        endforeach;
        return $theClasses;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $basePath = 'app/Http/Resources/ConcreteResources/';

        foreach (glob("$basePath*") as $file) {
            foreach (glob("$file/*Resource.php") as $file2) {
                $class = basename($file2, '.php');
                $resource = new $class([]);
            }
        }
        return 0;
    }
}
