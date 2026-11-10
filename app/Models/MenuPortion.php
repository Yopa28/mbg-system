<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuPortion extends Model
{
    protected $table = 'menu_portions';

    protected $fillable = [
        'menu_id',
        'portion_type',
        'photo_path',
        'total_weight_grams',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'total_weight_grams' => 'decimal:2',
        ];
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function nutrition(): HasOne
    {
        return $this->hasOne(PortionNutrition::class, 'portion_id');
    }

    public function foodComponents(): HasMany
    {
        return $this->hasMany(FoodComponent::class, 'portion_id')
            ->orderBy('display_order');
    }
}
