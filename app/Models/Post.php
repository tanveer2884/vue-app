<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content'
    ];

    public function scopeSearch(Builder $builder, string $query): Builder
    {
        return $builder->where(function (Builder $builder) use ($query) {
            $query = "%{$query}%";

            $builder->where('title', 'like', $query);
        });
    }
}
