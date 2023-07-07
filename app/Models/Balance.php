<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'balances';
    protected $fillable = [
        'montant',
        'userId',
        'montantTotalComission',
        'creationUserId',
        'modificationUserId'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function detailBalance()
    {
        return $this->hasOne(DetailBalance::class, 'balanceId');
    }
}
