<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static released()
 */
class Course extends Model
{
    use HasFactory;

    public function scopeReleased(Builder $query): Builder
    {
        return $query->whereNotNull('release_at');
    }
}
