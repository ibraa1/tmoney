<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'role',
        'numero_tel',
        'adresse',
        'login_attempts',
        'pays_id',
        'ville_id',
        'creation_user_id',
        'modification_user_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected $table = 'users';

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'pays_id');
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }
    public function balances()
    {
        return $this->hasMany(Balance::class, 'userId');
    }
    public function detailBalances()
    {
        return $this->hasManyThrough(DetailBalance::class, Balance::class, 'userId', 'balanceId');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'agentId');
    }
}
