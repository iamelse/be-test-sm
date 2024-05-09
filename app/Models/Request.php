<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
