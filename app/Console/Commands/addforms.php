<?php

namespace App\Console\Commands;

use App\Http\Requests\AbstractUpdateOrCreateRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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

                $fileContent .= "let validationRules = \n";

                $fileArray = [];
                foreach ($mainClass::generateInputRequestArray() as $param => $validationRules) {

//                    $fileContent .= "$param:{\n";
                    $element = 'Input';
                    $paramContent = ['required' => false];
                    $attributes = [];
                    $boolean = false;
                    $foundType = array_intersect( array_keys($typeFields) ,$validationRules);

                    $type = 'text';
                    if ($foundType) {
                        $type = $typeFields[array_pop($foundType)];
                    }
                    foreach ($validationRules as $validationRule) {
                        $valuedParams = ['max' => 'max', 'min' => 'min', 'before' => 'max', 'after' => 'min'];
                        foreach ($valuedParams as $valuedParam => $valuedParamForHTML) {
                            preg_match("#$valuedParam:(.*)#", $validationRule, $matches);

                            if ($matches) {
                                $attributes[$valuedParamForHTML] = $matches[1];
                            }
                        }

                        preg_match("#exists:(.*),(.*)#", $validationRule, $matches);

                        if ($matches) {
                            /*s*/echo '$matches= <pre>' . print_r($matches, true). '</pre>'; //todo r

                            $table = $matches[1];

                            $amountOfValues = DB::table($table)->count();
                            /*s*/echo '$amountOfValues= <pre>' . print_r($amountOfValues, true). '</pre>'; //todo r

                            if ($amountOfValues < 10) {
                                $element = 'Select';
                                $values = DB::table($table)->get();
                                $selectBuilders = $mainClass::$selectBuilders;
                                $options = [];
                                foreach ($values as $value) {
                                    $valueFieldValue = $value->{$selectBuilders[$table]['value']};
                                    $textFieldValue = $value->{$selectBuilders[$table]['text']};

                                    $options[] = ['text' => $textFieldValue, 'value' => $valueFieldValue];
                                }
                                $paramContent['options'] = $options;
                            } else {
                                $element = 'SelectSearch';
                            }
                        }

                        if ($validationRule == 'required') {
                            $attributes['required'] = '1';
                            $paramContent['required'] = true;
                        }

                        if ($validationRule == 'boolean') {
                            $boolean = true;
                        }
                    }

                    if ($boolean && $paramContent['required']) {
                        $type = 'checkbox';
                    } else {
                        $element = 'select';
                        $paramContent['options'] = [
                                ['text' => 'Not matter', 'value' => 0],
                                ['text' => 'No', 'value' => 1],
                                ['text' => 'Yes', 'value' => 2],
                            ];
                    }


                    if ($type) {
//                        $fileContent .= "type: $type,\n";
                        $paramContent['type']  = $type;
                    }
//                    $fileContent .= "},\n";

                    $attributes['id'] = $param;
                    $paramContent['id'] = $param;
                    $paramContent['attributes'] = $attributes;
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
