<?php

namespace App\Http\Requests\Column;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreColumnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'    => 'required|max:255',
            'board_id' => [
                'required',
                Rule::exists('boards', 'id')->where('user_id', Auth::id())
            ]
        ];
    }
}
