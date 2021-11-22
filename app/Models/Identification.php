<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identification extends Model
{

    protected $table = 'identification';
    public $timestamps = false;
    protected $fillable = ['person_id', 'type', 'value'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    
}
