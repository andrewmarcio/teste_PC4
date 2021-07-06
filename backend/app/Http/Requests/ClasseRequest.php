<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseRequest extends FormRequest
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
            "school_id" => "required|number|exists:schools,id",
            "nivel_id" => "required|number|exists:educational_levels,id",
            "year" => "required|date_format:Y",
            "serie" => "required|string",
            "turn" => "required|string"
        ];
    }
}
