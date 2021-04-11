<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PortfolioPreviewDetailsUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this->method();

        switch ($method) {
            case 'GET':
            case 'PUT':
            case 'DELETE':
            case 'PATCH':
                return [];

            case 'POST':
                return [
                    'first-name' => 'required',
                    'last-name' => 'required',
                    'email' => 'required|email',
                    'mobile' => 'required|numeric',
                    'template' => 'required',
                    'designation' => 'required',
                    'skill_level' => 'required',
                    'section_data' => 'required|json',
                    'image_hashes' => 'nullable|array|min:1',
                ];

            default:
                return abort(405);
        }
    }

    public function messages()
    {
        return [
            'image_hashes.required' => 'Gallery images are required',
            'image_hashes.array' => 'Gallery images must be array',
            'image_hashes.min' => 'Atleast one gallery image is required',
        ];
    }
}
