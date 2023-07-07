<?php

namespace Database\Seeders;

use App\Models\Balance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Balance::create([
            'montant' => 100000,
            'userId' => 1,
            'montantTotalComission' => 0,
            'creationUserId' => 1,
            'modificationUserId' =>1,
        ]);

        Balance::create([
            'montant' => 50000,
            'userId' => 2,
            'montantTotalComission' => 0,
            'creationUserId' => 1,
            'modificationUserId' =>1,
        ]);

        Balance::create([
            'montant' => 50000,
            'userId' => 3,
            'montantTotalComission' => 0,
            'creationUserId' => 1,
            'modificationUserId' =>1,
        ]);
    }
}
