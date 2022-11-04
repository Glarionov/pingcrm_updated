<?php

namespace App\Http\Resources\ConcreteResources\Appointments;

use App\Http\Resources\AbstractCollection;

class AppointmentCollection extends AbstractCollection
{
    public $collects = AppointmentResource::class;
}
