<?php

namespace App\Http\Services;

use App\Events\AppointmentCreated;
use App\Http\Resources\ConcreteResources\Appointments\AppleCollection;
use App\Http\Resources\ConcreteResources\Appointments\AppleResource;
use App\Models\Appointment;
use Illuminate\Support\Facades\Cookie;

class AppointmentService extends AbstractAdvancedResourceService
{
    public static int $itemsPerPage = 1000;

    public static string $mainModel = Appointment::class;

    protected static string $mainCollection = AppleCollection::class;
    protected static string $mainResource = AppleResource::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param array $requestData
     * @return array
     */
    public static function store(array $requestData): array
    {
        $requestDataWithUserId = array_merge($requestData, ['user_id' => Cookie::get('id')]);
        $appointment = parent::store($requestDataWithUserId);
        AppointmentCreated::dispatch($appointment);
        return ['success' => true, 'data' => $appointment];
    }
}
