<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'basePrice_cents',
        'duration_minutes',
        'description',

    ];
    /**
     * Get all of the orders for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Orders(): HasMany
    {
        return $this->hasMany(Orders::class);
    }
}
