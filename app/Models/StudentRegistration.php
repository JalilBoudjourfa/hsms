<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRegistration extends Model
{
    use HasFactory, HasLogs;

    protected $guarded = ['id'];

    protected $casts = [
        'deposition_date' => 'date',
    ];
    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function exRegistration()
    {
        return $this->hasOne(ExRegistration::class);
    }

    public function studentInterviews()
    {
        return $this->hasMany(StudentInterview::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
