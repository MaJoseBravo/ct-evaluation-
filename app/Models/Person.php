<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';
    public $timestamps = false;
    protected $fillable = ['name', 'last_name', 'birth_date', 'gender', 'country'];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function identifications()
    {
        return $this->hasMany(Identification::class);
    }
}
