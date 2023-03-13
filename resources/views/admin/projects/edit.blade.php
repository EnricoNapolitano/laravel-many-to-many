@extends('layouts.app')
@section('content')

<div class="container">
    
    <h1 class="mt-5">PROJECT</h1>
    <h2>{{$project->title}}</h2>

    @include('includes.admin.form')

</div>

@endsection