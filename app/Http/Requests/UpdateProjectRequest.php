<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'max:150',
                Rule::unique('projects', 'title')->ignore($this->project)
            ],
            'client' => 'nullable|string',
            'content'=> 'nullable|string',
            'url' => 'nullable|string',
            'typology_id' => 'nullable|exists:typologies,id',
            'technologies'=> 'exists:technologies,id'
        ];
    }
}
