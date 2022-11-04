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
        /*s*/echo 'get_declared_classes()= <pre>' . print_r(get_declared_classes(), true). '</pre>'; //todo r

        /*s*/echo '$namespace= <pre>' . print_r($namespace, true). '</pre>'; //todo r
        exit;//todo r
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
//            require_once $file;
            /*s*/
            echo '$file= <pre>' . print_r($file, true) . '</pre>'; //todo r

            foreach (glob("$file/*Resource.php") as $file2) {
                $class = basename($file2, '.php');
                $resource = new $class([]);
            }
        }
        return 0;
    }
}
