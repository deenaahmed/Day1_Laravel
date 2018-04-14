<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

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
		/*$usersall = User::all();
		$flag=0;
		foreach ($usersall as $user)	{	
		if($request->user_id==$user->id){
			$flag=1;
		}
        }
		if($flag==1)
		{
			 Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);
		}
		else
		{
			dd("hack detected");
		}*/
		$founduser=User::where('id',$request->user_id) -> first();
		if($founduser){
			 Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);
		}
		else
		{
			dd("hack detected");
		}
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
		$postold = Post::where('id', '=', $request->id)->first();
		$usersall = User::all();
		$flag=0;
		foreach ($usersall as $user)	{	
		if($request->user_id==$user->id){
			$flag=1;
		}
		}
		if($flag==1){
			 $posts = Post::where('id', '=', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);
		}
		else
		{
			dd("hack detected");
		}
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
