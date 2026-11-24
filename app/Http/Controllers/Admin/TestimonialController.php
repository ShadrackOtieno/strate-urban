<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Model;

class TestimonialController extends CrudController
{
    protected string $model = Testimonial::class;
    protected string $route = 'testimonials';
    protected string $title = 'Testimonials';
    protected string $singular = 'Testimonial';

    protected function columns(): array
    {
        return [
            ['key' => 'author_name', 'label' => 'Author'],
            ['key' => 'author_place', 'label' => 'From'],
            ['key' => 'is_active', 'label' => 'Shown', 'type' => 'bool'],
        ];
    }

    protected function fields(): array
    {
        return [
            'author_name' => ['label' => 'Client name'],
            'author_place' => ['label' => 'Town or area (optional)'],
            'quote' => ['label' => 'What they said (their real words)', 'type' => 'textarea', 'wide' => true, 'rows' => 5],
            'rating' => ['label' => 'Rating', 'type' => 'select', 'options' => [5 => '5 stars', 4 => '4 stars', 3 => '3 stars']],
            'sort_order' => ['label' => 'Display order', 'type' => 'number', 'default' => 0],
            'is_active' => ['label' => 'Show on website', 'type' => 'checkbox', 'default' => false, 'help' => 'Only publish testimonials clients have agreed to.'],
        ];
    }

    protected function rules(?Model $item): array
    {
        return [
            'author_name' => 'required|string|max:120',
            'author_place' => 'nullable|string|max:120',
            'quote' => 'required|string|max:2000',
            'rating' => 'required|integer|min:1|max:5',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable',
        ];
    }
}
