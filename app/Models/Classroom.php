<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory, HasLogs;

    protected $guarded = ['id'];

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function establishmentYear()
    {
        return $this->belongsTo(EstablishmentYear::class);
    }

    public function classType()
    {
        return $this->belongsTo(ClassType::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function studentRegistrations()
    {
        return $this->hasMany(StudentRegistration::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, StudentRegistration::class);
    }

    public function expenses()
    {
        return $this->belongsToMany(Expense::class)->withTimestamps();
    }

    /*
    |-------------------------------------
    | Scopes
    |-------------------------------------
    */

    public function scopeIsActive($query)
    {
        $query->where('classrooms.active', true);
    }

    public function scopeIsActiveYear($query)
    {
        $query->where('classrooms.active', true);
    }

    /**
     * @return Illuminate\Database\Query\Builder|Illuminate\Database\Eloquent\Builder $query
     */
    public static function scopeWithIfrastructureDetails($query)
    {
        return $query
            ->join('establishment_years', 'classrooms.establishment_year_id', '=', 'establishment_years.id')
            ->join('class_types', 'classrooms.class_type_id', '=', 'class_types.id')
            ->join('years', 'years.id', '=', 'establishment_years.year_id')
            ->select([
                'classrooms.id as id',
                'establishment_years.year_id',
                'establishment_years.establishment_id',
                'class_types.cycle_id',
                'class_types.name',
            ]);
    }

    /**
     * @return Illuminate\Database\Query\Builder|Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeWithRequestsCount($query)
    {
        return $query->withCount([
            'studentRegistrations',
            'studentRegistrations AS student_registrations_count_pending' => function ($query) {
                $query->where('status', 'pending');
            },
            'studentRegistrations AS student_registrations_count_accepted' => function ($query) {
                $query->where('status', 'accepted');
            },
            'studentRegistrations AS student_registrations_count_refused' => function ($query) {
                $query->where('status', 'refused');
            },
        ]);
    }
}
