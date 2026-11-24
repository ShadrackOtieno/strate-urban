<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];
    protected $casts = ['is_active' => 'boolean'];

    public const ICONS = [
        'home' => 'Home',
        'building' => 'Building',
        'key' => 'Key',
        'map-pin' => 'Land / location',
        'briefcase' => 'Briefcase',
        'shield-check' => 'Shield (legal checks)',
        'bar-chart' => 'Chart (investment)',
        'users' => 'People',
        'wrench' => 'Tools (management)',
        'file-text' => 'Document',
    ];

    public function scopeActive($q)
    {
        return $q->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }
}
