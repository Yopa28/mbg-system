<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuPublicationLog extends Model
{
    protected $table = 'menu_publication_logs';

    public $timestamps = false;

    protected $fillable = [
        'menu_id',
        'user_id',
        'menu_title',
        'serving_date',
        'action',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'serving_date' => 'date',
            'created_at' => 'datetime',
        ];
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
