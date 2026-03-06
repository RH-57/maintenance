<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'code',
        'name',
        'location_id',
        'brand',
        'model',
        'serial_number',
        'purchase_date',
        'status',
        'description'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
