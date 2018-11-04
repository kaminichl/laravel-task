<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;
use Auth;
/**
 * Class FilmDeleteRequest.
 */
class FilmDeleteRequest extends FormRequest
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
     * Response If the user is authorized to make this request.
     *
     * @return json response
     */
	public function forbiddenResponse()
	{
		return \Response::make('Restricted action!',403);
		
	}
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
	
	
   
}
