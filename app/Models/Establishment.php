<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory, HasLogs;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = ['id'];

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
}
