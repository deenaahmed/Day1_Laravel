<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StorePostRequest;

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
        // dd($request->all());
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
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
	

	public function update(Request $request)
    {	
	    $posts = Post::where('id', '=', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);
		
		//Post->update($request->all(), $request->id);
        
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
