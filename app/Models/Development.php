<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Development extends Model
{
    protected $guarded = [];
    protected $casts = ['is_active' => 'boolean'];

    public const STATUSES = [
        'completed' => 'Completed and ready',
        'under_construction' => 'Under construction',
        'off_plan' => 'Off plan',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true)->orderBy('sort_order')->orderBy('name');
    }

    public function getCoverUrlAttribute(): ?string
    {
        return media_url($this->cover_image);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    /** @return array<int, string> */
    public function lines(string $field): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $this->{$field}))));
    }

    /** "Studio: from KSh 9.5M" -> [['Studio', 'from KSh 9.5M'], ...] */
    public function unitTypeList(): array
    {
        return array_map(fn ($l) => array_pad(array_map('trim', explode(':', $l, 2)), 2, ''), $this->lines('unit_types'));
    }
}
