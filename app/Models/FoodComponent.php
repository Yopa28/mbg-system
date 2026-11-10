<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoodComponent extends Model
{
    protected $table = 'food_components';

    protected $fillable = [
        'portion_id',
        'name',
        'display_order',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'display_order' => 'integer',
        ];
    }

    public function portion(): BelongsTo
    {
        return $this->belongsTo(MenuPortion::class, 'portion_id');
    }

    public function componentIngredients(): HasMany
    {
        return $this->hasMany(ComponentIngredient::class, 'component_id');
    }
}
