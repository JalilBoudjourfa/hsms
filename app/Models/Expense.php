<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use NumberFormatter;

/**
 * @author medilies
 */
class Expense extends Model
{
    use HasFactory, SoftDeletes, HasLogs;

    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function otherYearExpenses()
    {
        return $this->hasMany(static::class, 'year_id', 'year_id')->where('id', '<>', $this->id);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class)->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /*
    |-------------------------------------
    |
    |-------------------------------------
    */

    public function getClassroomsArrAttribute(): array
    {
        $classrooms = [];

        foreach ($this->classrooms as $classroom) {
            $classrooms[] = "{$classroom->classType->alias} {$classroom->establishmentYear->establishment_id}";
        }

        return $classrooms;
    }

    public function getSpelledValueAttribute(): string
    {
        return (new NumberFormatter(app()->getLocale(), NumberFormatter::SPELLOUT))->format($this->value);
    }

    /*
    |-------------------------------------
    |
    |-------------------------------------
    */

    public function reducedValue(int $reduction = 0): int
    {
        return $this->value - $reduction;
    }
}
