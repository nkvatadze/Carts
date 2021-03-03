<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productGroupItems()
    {
        return $this->belongsToMany(UserProductGroup::class, 'product_group_items', 'product_id', 'group_id')
            ->withTimestamps();
    }
}
