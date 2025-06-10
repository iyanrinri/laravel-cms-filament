<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    const CACHE_KEYS = ['list' => 'categories.list', 'dropdown' => 'categories.dropdown'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($category) {
            foreach (self::CACHE_KEYS as $key) {
                cache()->forget($key);
            }
        });
        static::updated(function ($category) {
            foreach (self::CACHE_KEYS as $key) {
                cache()->forget($key);
            }
        });
        static::deleted(function ($category) {
            foreach (self::CACHE_KEYS as $key) {
                cache()->forget($key);
            }
        });
    }

    protected $guarded = [];

    public function news(): HasMany {
        return $this->hasMany(News::class, 'category_id');
    }
}
