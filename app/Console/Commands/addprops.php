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
//        /*s*/echo 'Testresource::class= <pre>' . print_r(Testresource::class, true). '</pre>'; //todo r

        foreach (glob('app/Http/Resources/PageResources/*.php') as $file)
        {
            require_once $file;

            /*s*/echo '$file= <pre>' . print_r($file, true). '</pre>'; //todo r

            $class = str_replace(['app/', '/', '.php'], ['\\App\\', '\\', ''], $file);
            $resource = new $class([]);

//            // get the file name of the current file without the extension
//            // which is essentially the class name
//            $class = basename($file, '.php');
//
//            if (class_exists($class))
//            {
//                $obj = new $class;
//                foreach(get_class_methods($obj) as $method)
//                {
//                    echo $method . '\n';
//                }
//            }
        }

//        $MyClasses = $this->classes_in_namespace('App\Http\Resources')
//;

//        /*s*/echo '$MyClasses= <pre>' . print_r($MyClasses, true). '</pre>'; //todo r


//        $resource = new \App\Http\Resources\Testresource([]);
        return 0;
    }
}
