<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_time',
    ];
    public function MenuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }
}
