<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstablishmentYear extends Model
{
    use HasFactory, HasLogs;

    protected $guarded = ['id'];

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function studentRegistrations()
    {
        return $this->hasManyThrough(StudentRegistration::class, Classroom::class);
    }

    /*
    |-------------------------------------
    | Accessors & mutators
    |-------------------------------------
    */
    public function getComposedKeyAttribute()
    {
        return "{$this->year_id}-{$this->establishment_id}";
    }
}
