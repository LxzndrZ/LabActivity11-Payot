<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    // my five categories, used by the rule and by the dropdown in the form
    public const CATEGORIES = ['Announcement', 'Health', 'Peace & Order', 'Ayuda', 'Livelihood'];

    // only users who have an author profile (Kagawads) can write posts
    public function authorize(): bool
    {
        return auth()->user()?->author !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:120'],
            'body' => ['required', 'string', 'min:20'],
            'category' => ['required', Rule::in(self::CATEGORIES)],
            'tags' => ['required', 'array', 'min:1'],
            'tags.*' => ['exists:tags,id'],
            'is_published' => ['boolean'],
        ];
    }
}