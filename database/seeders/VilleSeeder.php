<?php

namespace Database\Seeders;

use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Récupérer tous les pays de la table "payss"
        $pays = DB::table('payss')->get();

        foreach ($pays as $paysItem) {
            // Remplacez "nom_de_la_colonne_code_pays" par le nom de la colonne qui contient le code du pays dans la table "payss"
            $codePays = $paysItem->code;

            // Récupérer les villes par pays en utilisant le code du pays
            // Remplacez "nom_de_la_table_villes" par le nom de la table "villes"
            $villes = $this->getVillesByPaysCode($codePays);

            foreach ($villes as $ville) {
                DB::table('villes')->insert([
                    'pays_id' => $paysItem->id,
                    'nom' => $ville['name'],
                    'creation_user_id' => null,
                    'modification_user_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
    private function getVillesByPaysCode(string $codePays): array
    {
        $apiKey = 'cest_ibraa';
        $client = new Client();

        // Récupérer les villes en utilisant l'API GeoNames
        $response = $client->request('GET', 'http://api.geonames.org/searchJSON', [
            'query' => [
                'username' => $apiKey,
                'country' => $codePays,
                'type' => 'json',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        $villes = [];
        foreach ($data['geonames'] as $city) {
            $villes[] = ['name' => $city['name']];
        }

        return $villes;
    }
}
