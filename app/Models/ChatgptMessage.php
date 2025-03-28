<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatgptMessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'chatgpt_id',
        'user_id',
        'chatgpt_thread_id',
        'run_id',
        'role',
        'content',
        'type',
        'object',
        'attachments',
        'metadata',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
