<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'basePrice_cents',
        'duration_minutes',
        'description',
    ];
    public function MenuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }
    public function server(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
