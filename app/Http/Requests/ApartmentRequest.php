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
            "title" => "required",
            "description" => "required",
            "rooms" => "required",
            "beds" => "required",
            "bathrooms" => "required",
            "square_feet" => "integer|required",
            "address" => "required",
            "lat" => "required",
            "lon" => "required",
            "services" => "nullable",
            /* "views" => "required|integer|gte:0", */
            "poster_img" => "nullable"
        ];
    }
}
