<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StocksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => ['required', 'min:1', 'string'],
        ];
    }
}
