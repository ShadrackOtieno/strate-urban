<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];
    protected $casts = ['is_active' => 'boolean'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function developments()
    {
        return $this->hasMany(Development::class);
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true)->orderBy('sort_order')->orderBy('name');
    }

    public function getImageUrlAttribute(): ?string
    {
        return media_url($this->image);
    }
}
