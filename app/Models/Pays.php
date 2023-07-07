<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pays extends Model
{
    use
        HasFactory,
        SoftDeletes;
    protected $table = 'payss';

    public function villes()
    {
        return $this->hasMany(Ville::class, 'pays_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'pays_id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'paysId');
    }
}
