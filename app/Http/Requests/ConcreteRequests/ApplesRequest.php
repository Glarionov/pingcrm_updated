<?php

namespace App\Http\Requests\ConcreteRequests;

use App\Http\Requests\AbstractUpdateOrCreateRequest;
use App\Models\AppleQuality;

class ApplesRequest extends AbstractUpdateOrCreateRequest
{
    /**
     * List of rules for "update" request
     * @var array
     */
    public static array $updateRequestRules = [
        'size' => ['integer', 'max:10', 'min:2', 'nullable'],
        'weight' => ['integer', 'max:101', 'min:1', 'nullable'],
        'quality_id' => ['integer', 'exists:apple_qualities,id', 'nullable'],
        'is_eaten' => ['boolean', 'nullable'],
        'image' => ['image', 'nullable']
    ];

    /**
     * Fields required to be in "Create" requests
     * @var array
     */
    public static array $requiredToCreateFields = [
//        'size',
        'color',
//        'is_eaten'
    ];

    public static array $selectBuilders = [
        'apple_qualities' => ['text' => 'name', 'value' => 'id']
    ];
}
