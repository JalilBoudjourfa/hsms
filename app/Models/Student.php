<?php

namespace App\Models;

use ElaborateCode\AlgerianProvinces\Models\Wilaya;
use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RyanChandler\Comments\Concerns\HasComments;

class Student extends Model
{
    use HasFactory, SoftDeletes, HasComments, HasLogs;

    protected $guarded = ['id'];

    protected $casts = [
        'bday' => 'date',
    ];

    protected static function booted()
    {
        static::deleted(function ($student) {
            $student->studentInterviews->each->delete();
        });
    }

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

    public function clients()
    {
        return $this->hasManyThrough(Client::class, Family::class, 'id', 'family_id', 'family_id', 'id');
    }

    public function studentRegistrations()
    {
        return $this->hasMany(StudentRegistration::class);
    }

    public function studentInterviews()
    {
        return $this->hasManyThrough(StudentInterview::class, StudentRegistration::class);
    }

    public function latestRegistration()
    {
        return $this->hasOne(StudentRegistration::class)->latest();
    }

    public function latestClassroom()
    {
        return $this->hasOneThrough(Classroom::class, StudentRegistration::class, 'student_id', 'id', 'id', 'classroom_id')->latest();
    }

    public function birthWilaya()
    {
        return $this->belongsTo(Wilaya::class, 'bwilaya', config('algerian-provinces.columns_names.wilaya_fr_name'));
    }

    /*
    |-------------------------------------
    | Accessors
    |-------------------------------------
    */
    public function getArabicFullNameAttribute()
    {
        return "{$this->ar_fname} {$this->ar_lname}";
    }
}
