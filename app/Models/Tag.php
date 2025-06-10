<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    protected $guarded = [];

    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'tag_id');
    }
}
