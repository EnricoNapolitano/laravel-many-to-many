@extends('layouts.app')
@section('content')

<div class="container">

    <table class="table table-hover mt-5">
        <thead>
            <th class="text-primary">Technologies</th>
            <th class="text-end text-primary">Edit</th>
        </thead>
        <tbody>
            @forelse($technologies as $technology)
            <tr>
                <td>{{ $technology->label }}</td>
                <td class="text-end"><a href="{{route('admin.technologies.edit', $technology->id)}}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pencil"></i></a></td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="5">There aren't technologies.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- route to create a new tehcnology -->
    <a href="{{route('admin.technologies.create')}}" class="btn btn-outline-primary">Create a New One</a>

</div>

@endsection