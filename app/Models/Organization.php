<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'INN', 'bot_id', 'id'];

    public function bot(): BelongsTo
    {
        return $this->belongsTo(Bot::class);
    }

    public static function getSearchOrganizationQuery(
        ?string $search = '',
    ): Builder {
        $model = new Organization();
        $query = $model->query();

        return $query->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('INN', 'LIKE', '%' . $search . '%');
    }
}

