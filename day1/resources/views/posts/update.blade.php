@extends('layouts.master')


@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form  action="/posts/{{$posts->user_id}}" method="Post" enctype="multipart/form-data">
<?php echo method_field('PUT'); ?>
{{csrf_field()}}
<input type="hidden" name="id" value="{{$posts->id}}" >
Title :- <input type="text" name="title" value="{{$posts->title}}" >
<br><br>
Description :- 
<textarea name="description"> {{$posts->description}}</textarea>
<br>
<br>
Post Creator
<select class="form-control" name="user_id">
@foreach ($users as $user)
@if($user->id==$posts->user_id)
    <option value="{{$user->id}}" selected="selected">{{$user->name}}</option>
@else
	<option value="{{$user->id}}">{{$user->name}}</option>
@endif
@endforeach

</select>
<br>
<img src=" {{URL::asset('/storage/'.$posts['photo'])}}"></img>
<input  type="file"  name="photo" value="{{$posts->photo}}" >
<input type="submit" value="Update" class="btn btn-primary">
</form>

@endsection