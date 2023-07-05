<?php

namespace App\Http\Traits;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasCommentRelationshipTrait
{
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}