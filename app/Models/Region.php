<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $primaryKey = 'id_reg';
    public $timestamps = false;

    protected $fillable = [
        'description',
        'status',
    ];
}
