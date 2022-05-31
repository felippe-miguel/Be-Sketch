<?php

namespace App\Http\Requests\Column;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IndexColumnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'board_id' => [
                Rule::exists('boards', 'id')->where('user_id', Auth::id())
            ]
        ];
    }
}
