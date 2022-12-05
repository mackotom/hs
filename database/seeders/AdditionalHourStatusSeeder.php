<?php

namespace Database\Seeders;

use App\Models\AdditionalHourStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdditionalHourStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        AdditionalHourStatus::upsert([
            ['code' => 'requested', 'color' => 'dark'],
            ['code' => 'paid', 'color' => 'green'],
            ['code' => 'request_sended', 'color' => 'purple'],
            ['code' => 'request_canceled', 'color' => 'yellow'],
            ['code' => 'recovered', 'color' => 'indigo']
        ], ['code'], ['color']);

    }
}
