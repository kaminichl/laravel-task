<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;
/**
 * Class CommentDeleteRequest.
 */
class CommentDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		if(Auth::guest()) return false;
		$comment_id = $this->route('comment');
		if($user = Auth::user()) {
			$comment = Comment::find($comment_id):
			if($comment->user_id == $user->id) return true;
			return false;
		}
        
		return false;
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
        return [];
    }
	
	  public function messages()
    {
        return [];
    }
   
}
