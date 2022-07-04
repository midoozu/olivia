<?php

namespace Database\Seeders;

use App\Models\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [
            [
                'id'         => 1,
                'name'       => 'Lead',
                'created_at' => '2021-06-05 00:52:12',
                'updated_at' => '2021-06-05 00:52:12',
            ],
            [
                'id'         => 2,
                'name'       => 'Customer',
                'created_at' => '2021-06-05 00:52:12',
                'updated_at' => '2021-06-05 00:52:12',
            ],
            [
                'id'         => 3,
                'name'       => 'Partner',
                'created_at' => '2021-06-05 00:52:12',
                'updated_at' => '2021-06-05 00:52:12',
            ],
        ];

        CrmStatus::insert($crmStatuses);
    }
}
