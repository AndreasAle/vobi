<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'type', 'name', 'email', 'phone', 'subject', 'message', 'source_page', 'meta', 'status',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
