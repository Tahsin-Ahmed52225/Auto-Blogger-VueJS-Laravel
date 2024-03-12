<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'cover_image',
        'description',
        'user_id',
        'status',
    ];

    /**
     * Get the user that owns this post
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
