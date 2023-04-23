<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'username', 'token', 'created_at', 'updated_at'];

    public function Organization()
    {
        return $this->hasOne(Organization::class);
    }

}
