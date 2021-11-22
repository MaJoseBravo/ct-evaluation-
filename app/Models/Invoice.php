<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $table = 'invoice';
    public $timestamps = false;
    protected $fillable = ['identification_id', 'date', 'total', 'observation'];

    public function idntification()
    {
        return $this->belongsTo(Identification::class);
    }
}
