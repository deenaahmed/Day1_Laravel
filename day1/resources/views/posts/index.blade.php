@extends('layouts.master')


@section('content')

<h1>Lab 1 (Index and Destroy) </h1>
<button type="button" class="btn btn-success"  onclick="location.href = '/posts/create';">Create Post </button>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Posted by</th>
      <th scope="col">Created at</th>
	  <th scope="col">View action</th>
	  <th scope="col">Edit action</th>
	  <th scope="col">Delete action</th>
    </tr>
  </thead>


@foreach ($posts as $post)
<tr>
<td>{{ $post->id }}</td>
<td>{{ $post->title }}</td>
 <td> {{$post->user->name}}</td> 

 <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</td> 
<td><button type="button" class="btn btn-info" onclick="location.href = '/posts/{{$post->id}}';">View</button></td>
 <td><button type="button" class="btn btn-primary" onclick="location.href = '/posts/{{$post->id}}/edit';">Edit</button></td> 
 <td>
<form  action="/posts/{{$post->id}}" method="Post">
{{ method_field('DELETE') }}
{{csrf_field()}}
 <button type="submit" class="btn btn-danger">Delete</button>
 </form>
 </td>

</tr>
@endforeach

</table>
 <div class="panel-heading" style="display:flex; justify-content:center;align-items:center;">
        {{$posts->links()}}
    </div>


@endsection

