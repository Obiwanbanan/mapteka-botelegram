<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacies extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id', 'name', 'address', 'latitude', 'longitude'];

}
