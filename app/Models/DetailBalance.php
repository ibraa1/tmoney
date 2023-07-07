<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailBalance extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'detail_balances';
    protected $fillable = [
        'balanceId',
        'deviseId',
        'min',
        'max',
        'creationUserId',
        'modificationUserId'
    ];
    public function balance()
    {
        return $this->belongsTo(Balance::class, 'balanceId');
    }

    public function devise()
    {
        return $this->belongsTo(Devise::class, 'deviseId');
    }
}
