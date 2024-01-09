<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sessions';

    protected $fillable = [
        'email',
        'login_time',
        'token',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}

