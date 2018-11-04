<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;
/**
 * Class CommentRequest.
 */
class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		// if(Auth::guest()) return false;
		//return true;
        return true;
    }
	
	/**
     * Response If the user is authorized to make this request.
     *
     * @return json response
     */
	public function forbiddenResponse()
	{
		return \Response::make('Login to Post comments!',403);
		
	}
	
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'comments' => 'required|max:1000',
        ];
    }
	
	
   
}
