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
        'size' => ['integer', 'max:10', 'min:2'],
        'weight' => ['integer', 'max:101', 'min:1'],
        'quality_id' => ['integer', 'exists:apple_qualities,id'],
        'is_eaten' => ['boolean'],
        'image' => ['image']
//        'type_id' => ['integer', 'exists:appointments_types,id'],
//        'first_name' => ['string'],
//        'last_name' => ['string'],
//        'email' => ['email'],
//        'visit_date' => ['date', 'after:2000-01-01'],
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
