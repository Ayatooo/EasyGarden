<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumPost extends Model
{
    use HasFactory, SoftDeletes;

    public const CATEGORIES = [
        'Général',
        'Maladies',
        'Arrosage',
        'Engrais',
        'Exposition',
        'Plantation',
        'Taille',
        'Autre',
    ];

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
