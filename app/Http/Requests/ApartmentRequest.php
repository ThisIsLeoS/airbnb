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
            "description" => "required|string|max:255",
            "rooms" => "required|integer|gt:0|max:255",
            "beds" => "required|integer|gt:0|max:255",
            "bathrooms" => "required|integer|gt:0|max:255",
            "square_feet" => "integer|max:10000|gt:0",
            "address" => "required|string|max:255",
            "lat" => "required|numeric|between:-90,90",
            "lon" => "required|numeric|between:-180,180",
            "views" => "required|integer|gte:0",
            "poster_img" => "string|max:255|nullable"
        ];
    }
}
