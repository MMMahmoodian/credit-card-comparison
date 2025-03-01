<?php

namespace App\Http\Requests\v1\BackOffice;

use Illuminate\Foundation\Http\FormRequest;

class StoreEditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'product_type' => 'required|string',
            'edits' => 'required|array',
            'edits.title' => 'nullable|string',
            'edits.extra_info' => 'nullable|string',
            'edits.TAE' => 'nullable|numeric',
        ];
    }
}
