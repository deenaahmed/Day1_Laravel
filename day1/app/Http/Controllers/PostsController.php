<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\User;
use App\Http\Requests\StorePostRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;


class PostsController extends Controller
{
    public function index()
    {
		
        $posts = Post::paginate(1);
        return view('posts.index',[

            'posts' => $posts
        ]);
    }

    public function create()
    {
        $users = User::all();

        return view('posts.create',[
            'users' => $users
        ]);
    }

    public function store(StorePostRequest $request)
    {
			$path = Storage::putFile('avatars', $request->file('photo'));
			Storage::setVisibility($path, 'public');
			Post::create([
				'title' => $request->title,
				'description' => $request->description,
				'user_id' => $request->user_id,
				'photo' => $path
			]);

       return redirect(route('posts.index')); 
    }
	public function edit($id)
    {
		$users = User::all();
		$posts = Post::where('id', '=', $id)->first();
		return view('posts.update',[
            'posts' => $posts,
			'users' => $users
        ]);
    }
	

	public function update(UpdatePostRequest $request)
    {	
			 $posts = Post::where('id', '=', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
			'slug' => $slug
        ]);
       return redirect(route('posts.index')); 
    }
	public function show(Request $request)
    {
		$posts = Post::where('id', $request->id)->first();
		$users = User::where('id', $posts->user_id)->first();
        return view('posts.show',[
            'posts' => $posts,
			'users' => $users
        ]);
    }
	public function delete(Request $request)
    {
        $posts = Post::where('id', $request->id)->delete();
        return redirect(route('posts.index')); 
    }
}
