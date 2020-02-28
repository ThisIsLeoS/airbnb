<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
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
            "title" => "required|string|max:255",
            "description" => "required|string|max:255",
            "address" => "required|string|max:255",
            "square_feet" => "required|integer|gt:4|max:1000",
            "rooms" => "required|integer|gt:0|max:10",
            "beds" => "required|integer|gt:0|max:10",
            "bathrooms" => "required|integer|gt:0|max:10",
            "lat" => "required|numeric|between:-90,90",
            "lon" => "required|numeric|between:-180,180",
            "poster_img" => "image|max:2048",
            "images" => "array|max:4",
            "images.*" => "image|max:2048",
            "services" => "array|max:6",
            "services.*" => "string|max:30"
        ];
    }
}
