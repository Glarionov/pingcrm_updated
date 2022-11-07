<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AppleQuality;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppleQualitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        AppleQuality::create(['name' => 'low']);
        AppleQuality::create(['name' => 'medium']);
        AppleQuality::create(['name' => 'high']);
    }
}
