@extends('layouts.master')


@section('content')

<h1>Lab 1 (show one user) </h1>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">User info</h5>
    <p class="card-text"> Author: {{$users['name']}}</p>
	<p class="card-text"> Email: {{$users['email']}}</p>
  </div>
</div>


<br>
<br>
<img src=" {{URL::asset('/storage/'.$posts['photo'])}}"></img>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Post info</h5>
    <h6 class="card-subtitle mb-2 text-muted">Post Title: {{$posts['title']}}</h6>
    <p class="card-text"> Post Description: {{$posts['description']}}</p>
	<p class="card-text"> Post Creation: {{\Carbon\Carbon::parse($posts->created_at)->format('l  \\of F Y h:i:s A')}}</p>
  </div>
</div>
<div class="card" style="width: 18rem;">
<form method="post" action="/posts/{{$posts['id']}}">
{{csrf_field()}}
<input name="body" type="text" placeholder="Leave your comment">
<input type="submit" value="Comment" class="btn btn-primary">
</form>
@foreach ($posts->comments as $comment)
    <p>
        {{ $comment->body }}
    </p>
@endforeach
</div>

@endsection