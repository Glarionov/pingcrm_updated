<?php

namespace Database\Seeders;

use App\Http\Services\AppleService;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $applesData = [
            ['color' => 'red', 'quality_id' => '3', 'size' => 5],
            ['color' => 'yellow', 'quality_id' => '2', 'size' => 6],
            ['color' => 'green', 'quality_id' => '1', 'size' => 7],
        ];

        foreach ($applesData as $applesDatum) {
            AppleService::store($applesDatum);
        }
    }
}
