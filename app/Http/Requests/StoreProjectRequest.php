<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|max:150|unique:project,title', //questo UNIQUE serve per evitare che ci siano più titoli uguali
            'content' => 'nullable|string',
            'client' => 'required|max:255',
            'url' => 'nullable|url|max:255',
            'typology_id' => 'nullable|exists:typologies,id',
            'technologies'=> 'exists:technologies,id'
        ];
    }
}
