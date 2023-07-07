<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Monarobase\CountryList\CountryList;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $countryList = new CountryList();
        foreach ($countryList->getList('fr') as $code => $name) {
            DB::table('payss')->insert([
                'code' => $code,
                'nom' => $name,
                'creation_user_id' => null,
                'modification_user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
