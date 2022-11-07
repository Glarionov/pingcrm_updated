<?php

namespace App\Http\Resources\ConcreteResources\Apples;

use App\Http\Resources\AbstractResource;
use App\Models\Apple;
use App\Models\Appointment;

class AppleResource extends AbstractResource
{
    /** @var Apple */
    public $resource;

    const SIMPLE_FIELDS = ['color', 'size', 'weight', 'quality_id'];

    const PRETTY_DATE_FIELDS = ['created_at'];

    const CHAIN_FIELDS = [
        'quality' => ['quality', 'name']
    ];
}
