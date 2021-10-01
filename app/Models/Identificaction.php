<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identificaction extends Model
{
    use HasFactory;

    protected $table = 'identification';

    protected $fillable = [
        'person_id',
        'type',
        'value'
    ];
}
