<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    public const TYPE_OPTIONS = [
        'arrosage' => 'Arrosage',
        'taille' => 'Taille',
        'rempotage' => 'Rempotage',
        'engrais' => 'Engrais',
    ];

    protected $fillable = [
        'plant_id',
        'user_id',
        'task_type',
        'scheduled_at',
        'status',
    ];

    public function plant(): BelongsTo
    {
        return $this->belongsTo(Plant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'timestamp',
        ];
    }
}
