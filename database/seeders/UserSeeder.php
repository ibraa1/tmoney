<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nom' => 'Oularé',
                'prenom' => 'Ibrahima Douty',
                'email' => 'douty38oulare@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('pass'),
                'role' => 'admin',
                'adresse' => '123 Rue kobayah',
                'numero_tel' => '625651831',
                'pays_id' => 84, // ID du pays correspondant
                'ville_id' => 8314, // ID de la ville correspondante
                'creation_user_id' => null,
                'modification_user_id' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Kourouma',
                'prenom' => 'Moussa',
                'email' => 'moussa@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('pass'),
                'role' => 'client',
                'adresse' => '12345 Rue lambanyi',
                'numero_tel' => '662741755',
                'pays_id' => 84, // ID du pays correspondant
                'ville_id' => 8317, // ID de la ville correspondante
                'creation_user_id' => null,
                'modification_user_id' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Balde',
                'prenom' => 'Thierno abdoulaye',
                'email' => 'baldethierno@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('pass'),
                'role' => 'agent',
                'adresse' => '456 Avenue de la vie',
                'numero_tel' => '661619261',
                'pays_id' => 84, // ID du pays correspondant
                'ville_id' => 8315, // ID de la ville correspondante
                'creation_user_id' => null,
                'modification_user_id' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
