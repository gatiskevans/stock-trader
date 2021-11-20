<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellStocksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => ['required', 'int', 'min:1'],
        ];
    }
}
