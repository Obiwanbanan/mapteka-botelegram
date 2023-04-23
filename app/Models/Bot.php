<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bot extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'username', 'token', 'created_at', 'updated_at'];

    public function Organization(): HasOne
    {
        return $this->hasOne(Organization::class);
    }

}
