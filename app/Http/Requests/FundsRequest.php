<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FundsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cash' => ['required', 'numeric', 'min:0.01']
        ];
    }
}
