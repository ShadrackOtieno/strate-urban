<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $guarded = [];

    public const STATUSES = ['new' => 'New', 'contacted' => 'Contacted', 'viewing' => 'Viewing booked', 'won' => 'Closed won', 'lost' => 'Closed lost'];
    public const INTERESTS = [
        'general' => 'General question',
        'viewing' => 'Book a viewing',
        'buy' => 'Buy a property',
        'rent' => 'Rent a property',
        'invest' => 'Invest in a development',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function development()
    {
        return $this->belongsTo(Development::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function interestLabel(): string
    {
        return self::INTERESTS[$this->interest] ?? ucfirst($this->interest);
    }
}
