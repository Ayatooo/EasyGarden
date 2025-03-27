<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plant extends Model
{
    use HasFactory, SoftDeletes;

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
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
