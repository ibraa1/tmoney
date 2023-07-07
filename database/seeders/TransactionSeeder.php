<?php

namespace Database\Seeders;

use App\Models\Devise;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::truncate();

        // Obtenir les utilisateurs et les devises existantes
        $agents = User::where('role', 'agent')->get();
        $clients = User::where('role', 'client')->get();
        $devises = Devise::all();

        // Générer des transactions aléatoires
        for ($i = 1; $i <= 10; $i++) {
            $transaction = new Transaction([
                'montant' => rand(100, 1000),
                'type' => rand(0, 1) ? 'transfert' : 'retrait',
                'agentId' => $agents->random()->id,
                'deviseId' => $devises->random()->id,
                'date' => Carbon::now()->subDays(rand(1, 30)),
                'commission' => rand(0, 100),
                'remise' => rand(0, 50),
                'typeRemise' => 'pourcentage',
                'paysId' => rand(1, 5),
                'clientId' => $clients->random()->id,
                'receveurId' => $clients->random()->id,
                'creationUserId' => 1,
                'modificationUserId' => 1
            ]);

            $transaction->save();
        }
    }
}
