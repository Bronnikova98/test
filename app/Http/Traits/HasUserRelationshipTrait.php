<?php

namespace App\Http\Traits;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUserRelationshipTrait
{
    public function getUser(): User
    {
        return $this->user;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
}