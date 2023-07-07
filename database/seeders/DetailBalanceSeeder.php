<?php

namespace Database\Seeders;

use App\Models\DetailBalance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailBalance::create([
            'balanceId' => 1,
            'deviseId' => 1,
            'min' => 0,
            'max' => 1000000,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);

        DetailBalance::create([
            'balanceId' => 2,
            'deviseId' => 2,
            'min' => 0,
            'max' => 1000000,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);

        DetailBalance::create([
            'balanceId' => 3,
            'deviseId' => 2,
            'min' => 0,
            'max' => 1000000,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
    }
}
