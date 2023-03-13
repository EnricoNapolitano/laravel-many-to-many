@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="container table table-hover mt-5">
            <thead>
                <th class="text-primary">#id</th>
                <th class="text-primary">Title</th>
                <th class="text-primary">Type</th>
                <th class="text-center text-primary">Created at</th>
                <th class="text-center text-primary">Updated at</th>
                <th class="text-end text-primary">Actions</th>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->title }}</td>
                    <td><i class="text-primary fa-solid {{ $project->type->class_icon }}"></i> {{ $project->type->label }}</td>
                    <td class="text-center">{{ $project->created_at }}</td>
                    <td class="text-center">{{ $project->updated_at }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="5">There aren't projects yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary"><i class="fa-solid fa-upload me-2"></i>Upload Project</a>
    </div>


@endsection