<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author medilies
 */
class StudentInterview extends Model
{
    use HasFactory, SoftDeletes, HasLogs;

    protected $guarded = ['id'];

    protected $casts = [
        'schedule' => 'datetime',
    ];

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function studentRegistration()
    {
        return $this->belongsTo(StudentRegistration::class);
    }

    /*
    |-------------------------------------
    | Accessors & mutators
    |-------------------------------------
    */
    // public function getConclusionAttribute()
    // {
    //     return ucfirst($this->conclusion);
    // }
}
