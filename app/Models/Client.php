<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, HasLogs;

    protected $guarded = ['id'];

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function user()
    {
        return $this->morphOne(User::class, 'profilable');
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, Family::class, 'id', 'family_id', 'family_id', 'id');
    }
}
