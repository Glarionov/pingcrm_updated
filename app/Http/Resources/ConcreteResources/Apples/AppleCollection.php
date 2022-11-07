<?php

namespace App\Http\Resources\ConcreteResources\Apples;

use App\Http\Resources\AbstractCollection;

class AppleCollection extends AbstractCollection
{
    public $collects = AppleResource::class;
}
