<?php

namespace Pets\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
            'title.*' => 'required|min:2|max:255',
            'tags.*' => 'required',
            'content.*' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => transWord('Title (English)').' '.transWord('is required'),
            'title.min' => transWord('Min Characters of Title (English) are 2'),
            'title.max' => transWord('Max Characters of Title (English) are 255'),

            'tags.required' => transWord('Tags (English)').' '.transWord('is required'),

            'content.required' => transWord('Content (English)').' '.transWord('is required'),
            'content.max' => transWord('Min Characters of Content (English) are 2'),
        ];
    }
}
