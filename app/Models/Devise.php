<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devise extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'devises';
    protected $fillable = [
        'frequence',
        'deviseEntree',
        'deviseSortie',
        'courDevise',
        'dateDebut',
        'dateFin',
        'creationUserId',
        'modificationUserId',
    ];

    public function detailBalances()
    {
        return $this->hasMany(DetailBalance::class, 'deviseId');
    }
}
