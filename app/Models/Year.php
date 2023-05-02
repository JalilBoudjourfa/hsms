<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory, HasLogs;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function establishmentYears()
    {
        return $this->hasMany(EstablishmentYear::class);
    }

    public function classrooms()
    {
        return $this->hasManyThrough(Classroom::class, EstablishmentYear::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /*
    |-------------------------------------
    | Accessors & mutators
    |-------------------------------------
    */
    // public function getStateAttribute()
    // {
    //     return ucfirst($this->state);
    // }
}
