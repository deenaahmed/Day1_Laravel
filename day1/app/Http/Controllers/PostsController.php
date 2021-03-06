<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Auth;


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

    public function storecomment(Request $request)
    {

        $post = Post::find($request->id);
        $body = $request->body; // Get comment provided by user
            $user = Auth::user();             // Get posting user
            $post->addComment($body, $user);
            return redirect('/posts/'.$request->id); 
    }

    public function store(StorePostRequest $request)
    {
			$path = Storage::putFile('avatars', $request->file('photo'));
            Storage::setVisibility($path, 'public');
			Post::create([
				'title' => $request->title,
				'description' => $request->description,
				'user_id' => $request->user_id,
                'photo' => $path,
            ]);
            $post = Post::where('title', '=', $request->title)->first();
            $tags = $post->tag($request->tag_body);

       return redirect(route('posts.index')); 
    }
	public function edit($id)
    {
		$users = User::all();
        $posts = Post::where('id', '=', $id)->first();
        if(!$posts->photo){
            $posts->photo='/avatars/index.png';
        }
		return view('posts.update',[
            'posts' => $posts,
			'users' => $users
        ]);
    }
	

	public function update(UpdatePostRequest $request)
    {	
        $posts = Post::where('id', $request->id)->first();
        if($request->file('photo')==null){
			 $posts->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);
        }
        else{
            Storage::delete($posts->photo);
            $path = Storage::putFile('avatars', $request->file('photo'));
             Storage::setVisibility($path, 'public');
                 $posts->update([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'photo' => $path
            ]);
        }
        
       return redirect(route('posts.index')); 
    }
	public function show(Request $request)
    {
        $posts = Post::where('id', $request->id)->first();
        $tags = $posts->tags();
        if(!$posts->photo){
            $posts->photo='/avatars/index.png';
        }
		$users = User::where('id', $posts->user_id)->first();
        return view('posts.show',[
            'posts' => $posts,
            'users' => $users,
            'tags' => $tags,
        ]);
    }
	public function delete(Request $request)
    {
        $posts = Post::where('id', $request->id)->first();
        Storage::delete($posts->photo);
        $posts = Post::where('id', $request->id)->delete();
        return redirect(route('posts.index')); 
    }
}
