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
		/*$path = Storage::putFileAs(
			'photo', $request->file('photo'), 'photo.jpg'
		);*/
			//Storage::putFile('photo',  $request->file('photo'), 'photo.jpg');
			//dd("gg");
            //$image = Input::file('photo');
            //$filename = time() . '.' . $image->getClientOriginalExtension();
            //$path = public_path('images/' . $filename);
			//Image::make($image->getRealPath())->resize(200, 200)->save($path);
			//Storage::put('file.jpg', $request->photo);
			//Storage::putFile('photo', new File('/path/to/photo'));
			// $file     = request()->file('photo');
        	// $fileName = rand(1, 999) . $file->getClientOriginalName();
        	// $filePath = "../images/" . date("Y") . '/' . date("m") . "/" . $fileName;
        	// $file->storeAs('images/'. date("Y") . '/' . date("m") . '/', $fileName, 'uploads'); 
			// dd(File::create(['file_name' => $fileName, 'path' => $filePath, 'file_extension' => $file->getClientOriginalExtension()]));
			//$path = $request->file('photo')->store('/images');
			$path = Storage::putFile('avatars', $request->file('photo'));
			Storage::setVisibility($path, 'public');
			//Storage::put('file.jpg', $path, 'public');
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
		$contents = Storage::get('~/home/deena/Desktop/Day1_Laravel/day1/storage/app/'.$posts->photo);
		$users = User::where('id', $posts->user_id)->first();
        return view('posts.show',[
            'posts' => $posts,
			'users' => $users,
			'content' => $contents
        ]);
    }
	public function delete(Request $request)
    {
        $posts = Post::where('id', $request->id)->delete();
        return redirect(route('posts.index')); 
    }
}
