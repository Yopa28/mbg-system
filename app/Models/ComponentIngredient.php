<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComponentIngredient extends Model
{
    protected $table = 'component_ingredients';

    protected $fillable = [
        'component_id',
        'ingredient_id',
        'amount_grams',
    ];

    protected function casts(): array
    {
        return [
            'amount_grams' => 'decimal:2',
        ];
    }

    public function foodComponent(): BelongsTo
    {
        return $this->belongsTo(FoodComponent::class, 'component_id');
    }

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }
}
