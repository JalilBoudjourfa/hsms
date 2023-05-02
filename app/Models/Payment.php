<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author medilies
 */
class Payment extends Model
{
    use HasFactory, HasLogs;

    protected $guarded = ['id'];
    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function studentRegistration()
    {
        return $this->belongsTo(StudentRegistration::class);
    }
}
