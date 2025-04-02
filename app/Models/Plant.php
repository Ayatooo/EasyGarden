<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Plant extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        static::deleting(static function ($plant) {
            $plant->tasks()->delete();
        });
    }


    public const TYPE_OPTIONS = [
        'Fleur',
        'Plante verte',
        'Cactus',
        'Plante grasse',
        'Arbre',
        'Arbuste',
        'Plante aquatique',
    ];

    public const SUN_EXPOSURE_OPTIONS = [
        'Plein soleil',
        'Mi-ombre',
        'Ombre',
    ];

    public const SOIL_TYPE_OPTIONS = [
        'Argileux',
        'Sableux',
        'Limoneux',
        'Humifère',
        'Calcaire',
        'Tourbe',
        'Autre',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'type',
        'watering_frequency',
        'sun_exposure',
        'soil_type',
        'notes',
        'location',
    ];

    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image
            ? Storage::disk('s3')->temporaryUrl($this->image, now()->addMinutes(5))
            : null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
