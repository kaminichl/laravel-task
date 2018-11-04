<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;
/**
 * Class FilmRequest.
 */
class FilmRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'descripion' => 'required|max:1000',
            'rating' => 'required|integer|between:1,5',
			'release_date' => 'required|date',
			'ticket_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
			'country' => 'required',
			'genre' => 'required',
			'photo' => 'required|mimes:jpeg,jpg,png,gif|max:100000',
        ];
    }
	
	
   
}
