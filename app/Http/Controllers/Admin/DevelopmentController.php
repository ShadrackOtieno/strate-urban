<?php

namespace App\Http\Controllers\Admin;

use App\Models\Development;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;

class DevelopmentController extends CrudController
{
    protected string $model = Development::class;
    protected string $route = 'developments';
    protected string $title = 'Developments';
    protected string $singular = 'Development';

    protected function columns(): array
    {
        return [
            ['key' => 'cover_image', 'label' => 'Image', 'type' => 'image'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'status_label', 'label' => 'Status'],
            ['key' => 'sort_order', 'label' => 'Order'],
            ['key' => 'is_active', 'label' => 'Active', 'type' => 'bool'],
        ];
    }

    protected function fields(): array
    {
        return [
            'name' => ['label' => 'Development name'],
            'tagline' => ['label' => 'Tagline (one line)'],
            'location_id' => ['label' => 'Location', 'type' => 'select', 'options' => ['' => 'None'] + Location::orderBy('name')->pluck('name', 'id')->all()],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => Development::STATUSES],
            'address' => ['label' => 'Address or landmark', 'wide' => true],
            'cover_image' => ['label' => 'Cover photo (wide works best)', 'type' => 'image'],
            'summary' => ['label' => 'Short summary (shown on cards)', 'type' => 'textarea', 'wide' => true, 'rows' => 3],
            'body' => ['label' => 'Full description (blank line starts a new paragraph)', 'type' => 'textarea', 'wide' => true, 'rows' => 7],
            'highlights' => ['label' => 'Highlights (one per line)', 'type' => 'textarea', 'wide' => true, 'rows' => 5],
            'unit_types' => ['label' => 'Unit types (one per line, "Studio: from KSh 9,500,000")', 'type' => 'textarea', 'wide' => true, 'rows' => 4],
            'how_it_works' => ['label' => 'How buying or investing works (one step per line)', 'type' => 'textarea', 'wide' => true, 'rows' => 5, 'help' => 'Leave blank to use the standard four steps.'],
            'investment_note' => ['label' => 'Returns note (optional)', 'type' => 'textarea', 'wide' => true, 'rows' => 3, 'help' => 'Only state returns you can support. Projected returns are never guaranteed.'],
            'sort_order' => ['label' => 'Display order', 'type' => 'number', 'default' => 0],
            'is_active' => ['label' => 'Show on website', 'type' => 'checkbox', 'default' => true],
        ];
    }

    protected function rules(?Model $item): array
    {
        return [
            'name' => 'required|string|max:160',
            'tagline' => 'nullable|string|max:200',
            'location_id' => 'nullable|integer|exists:locations,id',
            'status' => 'required|in:'.implode(',', array_keys(Development::STATUSES)),
            'address' => 'nullable|string|max:200',
            'cover_image' => 'nullable|image|max:5120',
            'summary' => 'nullable|string|max:600',
            'body' => 'nullable|string|max:8000',
            'highlights' => 'nullable|string|max:3000',
            'unit_types' => 'nullable|string|max:2000',
            'how_it_works' => 'nullable|string|max:2000',
            'investment_note' => 'nullable|string|max:1500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable',
        ];
    }

    protected function prepare(array $data, ?Model $item): array
    {
        if (! $item) {
            $data['slug'] = $this->slugFor($data['name'], 'development');
        }
        return $data;
    }
}
