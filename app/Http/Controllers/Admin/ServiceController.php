<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class ServiceController extends CrudController
{
    protected string $model = Service::class;
    protected string $route = 'services';
    protected string $title = 'Services';
    protected string $singular = 'Service';

    protected function columns(): array
    {
        return [
            ['key' => 'icon', 'label' => 'Icon', 'type' => 'icon'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'sort_order', 'label' => 'Order'],
            ['key' => 'is_active', 'label' => 'Active', 'type' => 'bool'],
        ];
    }

    protected function fields(): array
    {
        return [
            'title' => ['label' => 'Title'],
            'icon' => ['label' => 'Icon', 'type' => 'select', 'options' => Service::ICONS],
            'summary' => ['label' => 'Short summary', 'type' => 'textarea', 'wide' => true, 'rows' => 3],
            'body' => ['label' => 'Details (optional)', 'type' => 'textarea', 'wide' => true, 'rows' => 5],
            'sort_order' => ['label' => 'Display order', 'type' => 'number', 'default' => 0],
            'is_active' => ['label' => 'Show on website', 'type' => 'checkbox', 'default' => true],
        ];
    }

    protected function rules(?Model $item): array
    {
        return [
            'title' => 'required|string|max:160',
            'icon' => 'nullable|in:'.implode(',', array_keys(Service::ICONS)),
            'summary' => 'required|string|max:500',
            'body' => 'nullable|string|max:4000',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable',
        ];
    }
}
