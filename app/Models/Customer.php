<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'dni'; 
    public $incrementing = false;
    protected $keyType = 'string'; 
    public $timestamps = false;

    public const CUSTOMER_ACTIVE = 'A';

    protected $fillable = [
        'dni', 'id_reg', 'id_com', 'email', 'name', 'last_name', 'address', 'date_reg', 'status',
    ];

    protected $casts = [
        'date_reg' => 'datetime',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'id_reg');
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'id_com');
    }
}
