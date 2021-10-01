<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'person';

    protected $fillable = [
        'name',
        'last_name',
        'birth_date',
        'gender',
        'country',
    ];
}
