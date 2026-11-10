<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'sppg_id',
        'created_by',
        'title',
        'description',
        'serving_date',
        'status',
        'scheduled_at',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'serving_date' => 'date',
            'scheduled_at' => 'datetime',
            'published_at' => 'datetime',
        ];
    }

    public function sppg(): BelongsTo
    {
        return $this->belongsTo(SppgProfile::class, 'sppg_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function portions(): HasMany
    {
        return $this->hasMany(MenuPortion::class, 'menu_id');
    }

    public function publicationLogs(): HasMany
    {
        return $this->hasMany(MenuPublicationLog::class, 'menu_id');
    }
}
