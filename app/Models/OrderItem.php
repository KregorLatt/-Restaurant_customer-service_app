<?php

namespace App\Models;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;
    protectedw $fillable = [
        'message',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
