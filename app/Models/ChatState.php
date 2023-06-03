<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatState extends Model
{
    protected $table = 'chat_states';

    protected $fillable = ['chat_id', 'state'];

    use HasFactory;
}
