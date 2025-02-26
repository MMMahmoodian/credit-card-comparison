<?php

namespace App\Http\Requests\v1\CreditCard;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sort' => ['nullable', 'string', 'in:title,TAE'],
            'sort_direction' => ['nullable', 'string', 'in:asc,desc'],
        ];
    }
}
