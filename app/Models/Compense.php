<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compense extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'compenses';
    protected $fillable = [
        'statut',
        'userId',
        'dateInitiation',
        'dateApprobation',
        'creationUserId',
        'modificationUserId'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function detailCompenses()
    {
        return $this->hasMany(DetailCompense::class, 'compenseId');
    }
}
