<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortionNutrition extends Model
{
    protected $table = 'portion_nutrition';

    protected $fillable = [
        'portion_id',
        'energy_kcal',
        'protein_g',
        'fat_g',
        'carbohydrate_g',
        'fiber_g',
        'sugar_g',
        'sodium_mg',
        'calcium_mg',
        'iron_mg',
        'vitamin_a_mcg',
        'verification_status',
        'correction_notes',
        'verified_by',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'energy_kcal' => 'decimal:2',
            'protein_g' => 'decimal:2',
            'fat_g' => 'decimal:2',
            'carbohydrate_g' => 'decimal:2',
            'fiber_g' => 'decimal:2',
            'sugar_g' => 'decimal:2',
            'sodium_mg' => 'decimal:2',
            'calcium_mg' => 'decimal:2',
            'iron_mg' => 'decimal:2',
            'vitamin_a_mcg' => 'decimal:2',
            'verified_at' => 'datetime',
        ];
    }

    public function portion(): BelongsTo
    {
        return $this->belongsTo(MenuPortion::class, 'portion_id');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
