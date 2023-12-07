<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestResponseLog extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'content', 'ip_address'];
}
