<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Model;

class FaqController extends CrudController
{
    protected string $model = Faq::class;
    protected string $route = 'faqs';
    protected string $title = 'FAQs';
    protected string $singular = 'FAQ';

    protected function columns(): array
    {
        return [
            ['key' => 'question', 'label' => 'Question'],
            ['key' => 'sort_order', 'label' => 'Order'],
            ['key' => 'is_active', 'label' => 'Shown', 'type' => 'bool'],
        ];
    }

    protected function fields(): array
    {
        return [
            'question' => ['label' => 'Question', 'wide' => true],
            'answer' => ['label' => 'Answer', 'type' => 'textarea', 'wide' => true, 'rows' => 6],
            'sort_order' => ['label' => 'Display order', 'type' => 'number', 'default' => 0],
            'is_active' => ['label' => 'Show on website', 'type' => 'checkbox', 'default' => true],
        ];
    }

    protected function rules(?Model $item): array
    {
        return [
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:4000',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable',
        ];
    }
}
