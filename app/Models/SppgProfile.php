<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SppgProfile extends Model
{
    protected $table = 'sppg_profiles';

    protected $fillable = [
        'code',
        'name',
        'address',
        'village',
        'district',
        'city',
        'province',
        'phone',
        'email',
        'logo_path',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'sppg_id');
    }
}
