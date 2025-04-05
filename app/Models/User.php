<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'suffixname',
        'username',
        'email',
        'password',
        'photo',
        'type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Accessors
    // public function getAvatarAttribute()
    // {
    //     return $this->photo ? asset('storage/' . $this->photo) : asset('images/default-avatar.png');
    // }

    public function getAvatarAttribute()
    {
        if ($this->photo && file_exists(storage_path('app/public/' . $this->photo))) {
            return asset('storage/' . $this->photo);
        } else {
            return asset('images/default-avatar.png');
        }
    }



    public function getFullnameAttribute()
    {
        $middleInitial = $this->middlename ? ' ' . $this->getMiddleinitialAttribute() . ' ' : ' ';
        return $this->firstname . $middleInitial . $this->lastname;
    }

    public function getMiddleinitialAttribute()
    {
        if (empty($this->middlename)) {
            return '';
        }

        return strtoupper(substr($this->middlename, 0, 1)) . '.';
    }

    // Validation for prefixname
    public static function getPrefixOptions()
    {
        return ['Mr', 'Mrs', 'Ms'];
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    protected static function booted()
    {
        static::saved(function ($user) {
            event(new \App\Events\UserSaved($user));
        });
    }
}
