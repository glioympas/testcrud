<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\Events\CustomerCreated;

class User extends Authenticatable
{
    use Notifiable;

    public function getCreatedAtAttribute($value)
    {
        $carbonDate = new Carbon($value);
        return $carbonDate->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        $carbonDate = new Carbon($value);
        return $carbonDate->diffForHumans();
    }

    public static function getAllCustomers()
    {
        return static::where('role_id', '1')->latest()->get();
    }

    public static function getAllAdministrators()
    {
        return static::where('role_id', '2')->latest()->get();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdministrator()
    {
        return $this->role->name === 'Administrator';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
