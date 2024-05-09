<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
