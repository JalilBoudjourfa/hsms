<?php

namespace App\Models;

use ElaborateCode\EloquentLogs\Concerns\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Family extends Model
{
    use HasFactory, HasRelationships, HasLogs;

    protected $guarded = ['id'];

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function father()
    {
        return $this->hasOne(Client::class)->where('family_title', 'father');
    }

    public function mother()
    {
        return $this->hasOne(Client::class)->where('family_title', 'mother');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function phones()
    {
        return $this->hasManyDeep(
            Phone::class,
            [Client::class, User::class],
            ['family_id', 'id'],
            ['id', 'user_id']
        );
    }
}
