<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacies extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id', 'name', 'address', 'map_url', 'city_id'];

    public static function getSearchPharmaciesQuery(
        ?string $search = '',
    ): Builder {
        $model = new Pharmacies();
        $query = $model->query();

        return $query->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('address', 'LIKE', '%' . $search . '%');
    }

    public static function getPharmaciesByOrganizationQuery(
        int $id,
    ): Builder {
        $model = new Pharmacies();
        $query = $model->query();

        return $query->where('organization_id', $id);
    }
}
