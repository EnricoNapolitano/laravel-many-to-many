@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <figure class="text-center">
        <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}">
    </figure>
    <div class="paragraph">
        <h1 class="mt-4 mb-3">{{ $project->title }}</h1>
        <p>{{ $project->content }}</p>
    </div>
    <div>
        <span><i class="fa-solid {{ $project->type->class_icon }}"></i> {{ $project->type->label }} || {{$project->updated_at}}</span>
    </div>
</div>
@endsection