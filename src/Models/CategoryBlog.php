<?php

namespace Giauphan\CrawlBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryBlog extends Model
{
    protected $guarded = [];
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}