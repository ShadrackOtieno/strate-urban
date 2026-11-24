<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class LocationController extends CrudController
{
    protected string $model = Location::class;
    protected string $route = 'locations';
    protected string $title = 'Locations';
    protected string $singular = 'Location';

    protected function columns(): array
    {
        return [
            ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'county', 'label' => 'County'],
            ['key' => 'sort_order', 'label' => 'Order'],
            ['key' => 'is_active', 'label' => 'Active', 'type' => 'bool'],
        ];
    }

    protected function fields(): array
    {
        return [
            'name' => ['label' => 'Name', 'help' => 'e.g. Nairobi, Westlands, Kiambu.'],
            'county' => ['label' => 'County'],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'wide' => true, 'rows' => 4],
            'image' => ['label' => 'Photo (wide works best)', 'type' => 'image'],
            'sort_order' => ['label' => 'Display order', 'type' => 'number', 'default' => 0],
            'is_active' => ['label' => 'Show on website', 'type' => 'checkbox', 'default' => true],
        ];
    }

    protected function rules(?Model $item): array
    {
        return [
            'name' => 'required|string|max:120',
            'county' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:2000',
            'image' => 'nullable|image|max:4096',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable',
        ];
    }

    protected function prepare(array $data, ?Model $item): array
    {
        if (! $item) {
            $data['slug'] = $this->slugFor($data['name'], 'location');
        }
        return $data;
    }
}
