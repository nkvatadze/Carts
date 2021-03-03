<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProductGroup extends Model
{
    use HasFactory;

    protected $primaryKey = 'group_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
