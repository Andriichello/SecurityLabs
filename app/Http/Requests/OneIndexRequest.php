<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OneIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'n' => ['required', 'numeric', 'min:0'],
            'm' => ['required', 'numeric', 'min:0'],
            'a' => ['required', 'numeric', 'min:0', 'lt:m'],
            'c' => ['required', 'numeric', 'min:0', 'lt:m'],
            'x' => ['required', 'numeric', 'min:0', 'lt:m'],
        ];
    }
}
