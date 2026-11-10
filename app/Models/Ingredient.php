<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
    protected $table = 'ingredients';

    protected $fillable = [
        'name',
        'category',
        'description',
    ];

    public function componentIngredients(): HasMany
    {
        return $this->hasMany(ComponentIngredient::class, 'ingredient_id');
    }
}
