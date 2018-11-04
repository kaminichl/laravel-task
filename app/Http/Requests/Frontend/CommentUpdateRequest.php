<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;
/**
 * Class CommentUpdateRequest.
 */
class CommentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
	 * Only admin user is authorized
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
		return \Response::make('Restricted action!',403);
		
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
            'comment' => 'required|max:1000',
        ];
    }
	
	public function messages()
    {
        return [];
    }
   
}
