<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Parsedown;

class ChatgptMessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'chatgpt_id',
        'run_id',
        'role',
        'content',
        'type',
        'object',
        'attachments',
        'metadata',
    ];

    protected $appends = [
        'answer',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'metadata' => 'array',
        'content' => 'array',
        'attachments' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAnswerAttribute(): string
    {
        return (new Parsedown())->text($this->content[0]['text']['value']);
    }
}
