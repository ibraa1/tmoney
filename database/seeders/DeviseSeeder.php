<?php

namespace Database\Seeders;

use App\Models\Devise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'XOF',
            'deviseSortie' => 'XOF',
            'courDevise' => 1,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);

        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'GNF',
            'deviseSortie' => 'GNF',
            'courDevise' => 1,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'XOF',
            'deviseSortie' => 'USD',
            'courDevise' => 0.0016,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'USD',
            'deviseSortie' => 'XOF',
            'courDevise' => 625.01,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'XOF',
            'deviseSortie' => 'EURO',
            'courDevise' => 0.0016,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'EURO',
            'deviseSortie' => 'XOF',
            'courDevise' => 611.73,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'GNF',
            'deviseSortie' => 'XOF',
            'courDevise' => 0.0695,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'XOF',
            'deviseSortie' => 'GNF',
            'courDevise' => 14.3810,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);


        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'GNF',
            'deviseSortie' => 'EURO',
            'courDevise' => 0.000108,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'EURO',
            'deviseSortie' => 'GNF',
            'courDevise' =>  9261.74 ,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'USD',
            'deviseSortie' => 'GNF',
            'courDevise' => 8645.5784,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
        Devise::create([
            'frequence' => 'Quotidien',
            'deviseEntree' => 'GNF',
            'deviseSortie' => 'USD',
            'courDevise' => 0.000115666,
            'dateDebut' => '2023-01-01',
            'dateFin' => null,
            'creationUserId' => 1,
            'modificationUserId' => 1,
        ]);
    }
}
