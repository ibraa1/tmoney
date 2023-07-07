<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailCompense extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'detail_compenses';
    protected $fillable = [
        'compenseId',
        'deviseId',
        'montant',
        'type',
        'modePaiement',
        'creationUserId',
        'modificationUserId'
    ];
    public function compense()
    {
        return $this->belongsTo(Compense::class, 'compenseId');
    }

    public function devise()
    {
        return $this->belongsTo(Devise::class, 'deviseId');
    }
}
