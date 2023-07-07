<?php

namespace Database\Seeders;

use App\Models\Compense;
use App\Models\DetailCompense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'une instance de Compense
        $compense = new Compense();
        $compense->userId = 1;
        $compense->statut = 'en attente';
        $compense->date = '2023-07-01';
        $compense->creationUserId = 1;
        $compense->modificationUserId = 1;
        $compense->save();

        // Création d'un détail de compense associé
        $detailCompense = new DetailCompense();
        $detailCompense->compenseId = $compense->id;
        $detailCompense->montant = 1000;
        $detailCompense->deviseId = 1;
        $detailCompense->type = 'balance';
        $detailCompense->modePaiement = 'espèce';
        $detailCompense->creationUserId = 1;
        $detailCompense->modificationUserId = 1;
        $detailCompense->save();
    }
}
