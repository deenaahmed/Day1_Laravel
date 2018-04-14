@extends('layouts.master')


@section('content')
<form  action="/posts/{{$posts->user_id}}" method="Post">
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
<input type="submit" value="Update" class="btn btn-primary">
</form>

@endsection