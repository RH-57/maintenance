<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChecklistTemplate extends Model
{
    protected $fillable = [
        'name',
        'description',
        'frequency_days',
    ];

    protected $casts = [
        'frequency_days' => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ChecklistItem::class);
    }
}
