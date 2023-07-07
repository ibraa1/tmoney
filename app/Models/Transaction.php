<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'transactions';

    protected $fillable = [
        'montant',
        'type',
        'agentId',
        'deviseId',
        'date',
        'code',
        'statut',
        'commission',
        'adminCommission',
        'retraitantCommission',
        'agentCommission',
        'remise',
        'typeRemise',
        'paysId',
        'montantRecu',
        'clientId',
        'receveurId',
        'montantEnvoye',
        'creationUserId',
        'modificationUserId'
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agentId');
    }

    public function devise()
    {
        return $this->belongsTo(Devise::class, 'deviseId');
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'paysId');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'clientId');
    }
    public function receveur()
    {
        return $this->belongsTo(User::class, 'receveurId');
    }
}
