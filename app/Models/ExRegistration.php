<?php

namespace App\Models;

use ElaborateCode\AlgerianProvinces\Models\Wilaya;
use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author medilies
 */
class ExRegistration extends Model
{
    use HasFactory, HasLogs;

    protected $guarded = ['id'];

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function studentRegistration()
    {
        return $this->belongsTo(StudentRegistration::class);
    }

    public function classType()
    {
        return $this->belongsTo(ClassType::class);
    }

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class, 'ex_est_wilaya', config('algerian-provinces.columns_names.wilaya_fr_name'));
    }

    /*
    |-------------------------------------
    | Accessors
    |-------------------------------------
    */
    public function getExEstablishmentAttribute()
    {
        return
            __(strtolower($this->establishment_type).' school').
            " \"{$this->establishment_name}\" à ".
            strtoupper($this->ex_est_wilaya);
    }
}
