<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use RyanChandler\Comments\Models\Comment;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function profilable()
    {
        return $this->morphTo();
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function primaryPhone()
    {
        return $this->hasOne(Phone::class)->where('primary', true);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /*
    |-------------------------------------
    | Mutators
    |-------------------------------------
    */
    public function setFnameAttribute($value)
    {
        $this->attributes['fname'] = ucwords(strtolower($value));
    }

    public function setLnameAttribute($value)
    {
        $this->attributes['lname'] = strtoupper($value);
    }

    public function setEmailAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['email'] = null;
        } else {
            $this->attributes['email'] = strtolower($value);
        }
    }

    /*
    |-------------------------------------
    | Accessors
    |-------------------------------------
    */
    public function getNameAttribute()
    {
        return "{$this->fname} {$this->lname}";
    }
}
