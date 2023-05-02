<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author medilies
 */
class Room extends Model
{
    use HasFactory, HasLogs;

    protected $guarded = ['id'];

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function establishmentYear()
    {
        return $this->belongsTo(EstablishmentYear::class);
    }
}
