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

        $directory = '/';

        $basePath = 'app/Http/Requests/ConcreteRequests/';

        $typeFields = ['date' => 'date', 'integer' => 'number', 'email' => 'email'];

        foreach (glob("$basePath*") as $file)
        {
            $class = str_replace(['app/', '/', '.php'], ['\\App\\', '\\', ''], $file);
            $mainClass = new $class([]);
            $fileContent = '';
            if ($mainClass instanceof AbstractUpdateOrCreateRequest) {

                $fileContent .= "let validationRules = \n";

                $fileArray = [];
                foreach ($mainClass::generateInputRequestArray() as $param => $validationRules) {

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
                            $table = $matches[1];

                            $amountOfValues = DB::table($table)->count();
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

                        switch ($validationRule) {
                            case 'file': case 'image':
                                $type = 'file';
                                $element = 'InputFile';
                                break;

                            case 'required':
                                $attributes['required'] = '1';
                                $paramContent['required'] = true;
                                break;

                            case 'boolean':
                                $boolean = true;
                        }
                    }

                    if ($boolean) {
                        if ($paramContent['required']) {
                            $type = 'checkbox';
                        } else {
                            $element = 'select';
                            $paramContent['options'] = [
                                ['text' => 'Not matter', 'value' => ''],
                                ['text' => 'No', 'value' => 0],
                                ['text' => 'Yes', 'value' => 1],
                            ];
                        }
                    }

                    if ($type) {
                        $paramContent['type']  = $type;
                    }

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

                $class = get_class($mainClass);
                $resultFileName = preg_replace('#App\\\Http\\\Requests\\\ConcreteRequests\\\(.*)Request#', '$1', $class);

                file_put_contents("resources/js/FormArrays/$resultFileName.js", $fileContent);
            }
        }

        return 0;
    }
}
