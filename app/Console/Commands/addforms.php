<?php

namespace App\Console\Commands;

use App\Http\Requests\AbstractUpdateOrCreateRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class addforms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:addforms';

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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

//        $directory = '/app/Http/Resources/ConcreteResources';
        $directory = '/';
        $directories = Storage::directories($directory);

//        /*s*/echo '$directories= <pre>' . print_r($directories, true). '</pre>'; //todo r

        $basePath = 'app/Http/Requests/ConcreteRequests/';

        $typeFields = ['date' => 'date', 'integer' => 'number', 'email' => 'email'];

        foreach (glob("$basePath*") as $file)
        {
            $class = str_replace(['app/', '/', '.php'], ['\\App\\', '\\', ''], $file);
//            require_once $file;
            $mainClass = new $class([]);

//            $fileContent = "let requiredFields = [\n";
            $fileContent = '';
            if ($mainClass instanceof AbstractUpdateOrCreateRequest) {
//                $requiredFields = [];
//
//                foreach ($mainClass::$requiredToCreateFields as $requiredToCreateField) {
//                    $requiredFields[] = "'$requiredToCreateField'";
//                }
//                $fileContent .= implode(",\n", $requiredFields) . "\n];\n";
/*s*/echo '$fileContent= <pre>' . print_r($fileContent, true). '</pre>'; //todo r

                $fileContent .= "let validationRules = \n";

                $fileArray = [];
                foreach ($mainClass::generateInputRequestArray() as $param => $validationRules) {
//                    $fileContent .= "$param:{\n";


                    $element = 'Input';
                    $paramContent = [];
                    $attributes = [];
                    $attributesWithoutValue = [];
                    $foundType = array_intersect( array_keys($typeFields) ,$validationRules);
                    /*s*/echo '$foundType= <pre>' . print_r($foundType, true). '</pre>'; //todo r

                    $type = 'text';
                    if ($foundType) {
                        /*s*/echo '$foundType= <pre>' . print_r($foundType, true). '</pre>'; //todo r
                        $type = $typeFields[array_pop($foundType)];
                    }
                    foreach ($validationRules as $validationRule) {
                        $valuedParams = ['max' => 'max', 'min' => 'min', 'before' => 'max', 'after' => 'min'];
                        foreach ($valuedParams as $valuedParam => $valuedParamForHTML) {
                            preg_match("#$valuedParam:(.*)#", $validationRule, $matches);
                            /*s*/echo '$matches= <pre>' . print_r($matches, true). '</pre>'; //todo r

                            if ($matches) {
                                $attributes[$valuedParamForHTML] = $matches[1];
                            }
                        }

                        if ($validationRule == 'required') {
                            $attributesWithoutValue[] = 'required';
                            $attributes['required'] = '1';
                            $paramContent['required'] = true;
                        } else {
                            $paramContent['required'] = false;
                        }

                    }



                    if ($type) {
//                        $fileContent .= "type: $type,\n";
                        $paramContent['type']  = $type;
                    }
//                    $fileContent .= "},\n";

                    $attributes['id'] = $param;
                    $paramContent['id'] = $param;
                    $paramContent['attributes'] = $attributes;
                    $paramContent['attributes_wo_value'] = $attributesWithoutValue;
                    $paramContent['element'] = $element;
                    $paramContent['label'] = $param;
                    $paramContent['name'] = $param;
                    $paramContent['value'] = '';
                    $fileArray[$param] = $paramContent;
                }

                $fileContent .= json_encode($fileArray, JSON_PRETTY_PRINT);

                $fileContent.= "\nexport default validationRules";

//                /*s*/echo '$fileContent= <pre>' . print_r($fileContent, true). '</pre>'; //todo r

                $class = get_class($mainClass);
                $resultFileName = preg_replace('#App\\\Http\\\Requests\\\ConcreteRequests\\\(.*)Request#', '$1', $class);

                /*s*/echo '$class= <pre>' . print_r($class, true). '</pre>'; //todo r
/*s*/echo '$resultFileName= <pre>' . print_r($resultFileName, true). '</pre>'; //todo r

                file_put_contents("resources/js/FormArrays/$resultFileName.js", $fileContent);
            }




//            $class = str_replace(['app/', '/', '.php'], ['\\App\\', '\\', ''], $file);
//            $resource = new $class([]);

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

        return 0;
    }
}
