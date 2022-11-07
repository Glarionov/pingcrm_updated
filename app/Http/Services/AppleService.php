<?php

namespace App\Http\Services;

use App\Events\AppointmentCreated;
use App\Http\Requests\AbstractUpdateOrCreateRequest;
use App\Http\Resources\ConcreteResources\Apples\AppleCollection;
use App\Models\Apple;
use App\Models\Appointment;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class AppleService extends AbstractAdvancedResourceService
{
    public static int $itemsPerPage = 1000;

    public static string $mainModel = Apple::class;

    public static string $mainCollection = AppleCollection::class;

    protected static array $listSearchParams = [
        'id' => ['list'],
        'weight' => ['simple'],
        'size' => ['range'],
        'color' => ['like'],
        'quality_id' => ['simple'],
    ];

    public static function list(array $requestData = null, array $filter = [], array $withs = [], $orderBy = ['id', 'desc']) {
        return parent::list($requestData, $filter, ['quality']);
    }
}
