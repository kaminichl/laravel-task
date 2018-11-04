<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CommentRequest;
use App\Http\Requests\Frontend\CommentUpdateRequest;
use App\Http\Requests\Frontend\CommentDeleteRequest;
use App\Comment;
use App\Film;

class CommentController extends Controller
{
    public function index($id)
    {
        $film = Film::findOrFail($id);
		return $film->comments()->get();
    }
 
    

    public function store($id, CommentRequest $request)
    {
		
		$film = Film::findOrFail($id);
		$data = $request->all();
		$data['film_id'] = $film->id;
		
        return Comment::create($data);
    }

    public function update($id, CommentUpdateRequest $request)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return $comment;
    }

    public function delete($id, CommentDeleteRequest $request)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return 204;
    }
}
