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

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Post info</h5>
    <h6 class="card-subtitle mb-2 text-muted">Post Title: {{$posts['title']}}</h6>
    <p class="card-text"> Post Description: {{$posts['description']}}</p>
	<p class="card-text"> Post Creation: {{\Carbon\Carbon::parse($posts->created_at)->format('l  \\of F Y h:i:s A')}}</p>
  </div>
</div>

@endsection