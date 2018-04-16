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
<form method="post" action="/posts" enctype="multipart/form-data">
{{csrf_field()}}
Title :- <input type="text" name="title" value="Post Title">
<br><br>
Description :- 
<textarea name="description" value="Post Description"></textarea>
<br>
<br>
Post Creator
<select class="form-control" name="user_id">
@foreach ($users as $user)
    <option value="{{$user->id}}">{{$user->name}}</option>
@endforeach

</select>
<input  type="file"  name="photo"  >
<input type="submit" value="Submit" class="btn btn-primary">
</form>

@endsection