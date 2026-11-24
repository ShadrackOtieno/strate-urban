<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];
    protected $casts = ['is_featured' => 'boolean', 'is_hot' => 'boolean', 'is_active' => 'boolean', 'price' => 'integer', 'size' => 'float'];

    public const TYPES = ['apartment' => 'Apartment', 'house' => 'House', 'land' => 'Land', 'commercial' => 'Commercial'];
    public const PURPOSES = ['sale' => 'For sale', 'rent' => 'For rent', 'lease' => 'For lease'];
    public const STATUSES = ['available' => 'Available', 'reserved' => 'Reserved', 'sold' => 'Sold', 'let' => 'Let'];
    public const PERIODS = ['' => 'One-off price', 'month' => 'per month', 'year' => 'per year'];
    public const SIZE_UNITS = ['sqm' => 'sq m', 'sqft' => 'sq ft', 'acres' => 'acres'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function development()
    {
        return $this->belongsTo(Development::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class)->orderBy('sort_order')->orderBy('id');
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function getCoverUrlAttribute(): ?string
    {
        return media_url($this->cover_image);
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? ucfirst($this->type);
    }

    public function getPurposeLabelAttribute(): string
    {
        return self::PURPOSES[$this->purpose] ?? ucfirst($this->purpose);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function getPriceLabelAttribute(): string
    {
        if (! $this->price) {
            return 'Price on request';
        }
        $s = 'KSh '.number_format($this->price);
        return $this->price_period ? $s.' / '.($this->price_period === 'month' ? 'month' : 'year') : $s;
    }

    public function getSizeLabelAttribute(): ?string
    {
        if (! $this->size) {
            return null;
        }
        $n = rtrim(rtrim(number_format($this->size, 2), '0'), '.');
        return $n.' '.(self::SIZE_UNITS[$this->size_unit] ?? $this->size_unit);
    }

    /** @return array<int, string> */
    public function featureList(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $this->features))));
    }

    public function isUnavailable(): bool
    {
        return in_array($this->status, ['sold', 'let'], true);
    }
}
