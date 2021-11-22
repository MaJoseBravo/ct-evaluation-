<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $table = 'address';
    public $timestamps = false;
    protected $fillable = ['person_id', 'country', 'postal_code', 'detail'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
