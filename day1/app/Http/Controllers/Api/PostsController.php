<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function index(){
        $posts=Post::paginate(1);
        return PostResource::collection($posts);
    }  
    public function store(StorePostRequest $request){
        $post = Post::create($request->all());
        return new PostResource($post);
    }  
}
