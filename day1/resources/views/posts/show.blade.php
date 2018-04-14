@extends('layouts.master')


@section('content')

<h1>Lab 1 (show one user) </h1>
<div>
Author: {{$users['name']}}
<br>
<br>
Email: {{$users['email']}}

</div>
<br>
<br>
<br>

<div>
Post Title: {{$posts['title']}}
<br>
<br>
Post Description: {{$posts['description']}}
<br>
<br>
Post Creation: {{\Carbon\Carbon::parse($posts->created_at)->format('l js \\of F Y h:i:s A')}}
</div>

@endsection