<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static released()
 */
class Course extends Model
{
    use HasFactory;

    protected $casts = ['learnings' => 'array'];

    public function scopeReleased(Builder $query): Builder
    {
        return $query->whereNotNull('release_at');
    }
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
