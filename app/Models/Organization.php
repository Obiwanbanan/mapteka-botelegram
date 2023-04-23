<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Organization extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'INN', 'bot_id'];

    public function bot(): BelongsTo
    {
        return $this->belongsTo(Bot::class);
    }
}

