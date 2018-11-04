<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\FilmRequest;
use App\Http\Requests\Frontend\FilmUpdateRequest;
use App\Http\Requests\Frontend\FilmDeleteRequest;
use App\Http\Controllers\Controller;
use App\Film;
use App\Services\Slug;
use File;

class FilmController extends Controller
{
    public function index()
    {
        return Film::all();
    }
 
    public function show($slug)
    {
		$flim = new Film();
        $film = $flim->findBySlug($slug);
        return $film;
    }

    public function store(FilmRequest $request)
    {
		$data = $request->all();
		$slug = new Slug();
		$slug = $slug->createSlug($data['name']);
		$data['slug'] = $slug;
		$genre = $request->input('genre');
		$genre = (is_array($genre)) ? implode(',', $genre) : $genre;
		$data['genre'] = $genre;
		
		if ($request->hasFile('photo')) {
			$file = $request->file('photo');
			$filename = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$photo = sha1($filename . time()) . '.' . $extension;
			$destinationPath = public_path() . '/img/films/';
			$file->move($destinationPath, $photo);
			
			$data['photo'] = $photo;
        }else {
			$inputs['photo'] = '';
		} 
		
        return Film::create($data);
    }
	


    public function update(FilmUpdateRequest $request, $id)
    {
		$film = Film::findOrFail($id);
		if($film) {
			$data = $request->all();
			$slug = new Slug();
			$slug = $slug->createSlug($data['name'],$id);
			$data['slug'] = $slug;
			$genre = $request->input('genre');
			$genre = (is_array($genre)) ? implode(',', $genre) : $genre;
			$data['genre'] = $genre;
			
			if ($request->hasFile('photo')) {
				$existing_image = $this->deteleFilmPhoto($film->photo);
				$file = $request->file('photo');
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$photo = sha1($filename . time()) . '.' . $extension;
				$destinationPath = public_path() . '/img/films/';
				$file->move($destinationPath, $photo);
				$data['photo'] = $photo;
			}
			
			
				$film->update($data);
				return $film;
		}
		return 404;
    }
	
	private function deteleFilmPhoto($filename)
	{
		if($filename != '') {
			$existing_file = public_path() . '/img/films/'.$filename;
			
				if(File::exists($existing_file)) {
					File::delete($existing_file);
				}
			}
	}

    public function delete(FilmDeleteRequest $request, $id)
    {
        $film = Film::findOrFail($id);
		if($film) {
			$this->deteleFilmPhoto($film->photo);
			$film->delete();
			return 204;
		} 
		return 404;
    }
}
