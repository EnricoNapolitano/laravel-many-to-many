<main class="mt-5">

    @include('includes.alerts.error')

    @if($project->exists)
    <!-- form edit -->
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" novalidate>
    @method('PUT')
    
    @else
    <!-- form upload -->
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @endif
    @csrf

    <div class="row">

        <!-- title -->
        <div class="col-8 mb-3">
            <h4><label for="title" class="form-label">Title</label></h4>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Write a title for your project" name="title" value="{{ old('title', $project->title) }}" minlength="5" maxlength="50" required>
            @error('title')
            <div class="text-danger p-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- select -->
        <div class="col-4 mb-3">
            <h4><label for="type_id" class="form-label">Type</label></h4>
            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                @foreach($types as $type)
                <option value="0">Choose type of project</option>
                <option @if(old('type_id', $project->type_id) == $type->id) selected @endif value="{{$type->id}}">{{$type->label}}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="text-danger p-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- input for image -->
        <div class="col-12 mb-3">
            <h4><label for="image" class="form-label @error('image') is-invalid @enderror">Project Image</label></h4>
            <input type="file" class="form-control" id="image" name="image" required>
            @error('image')
                <div class="text-danger p-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- textarea -->
        <div class="col-12 mb-3">
            <h4><label for="content" class="form-label">Project Content</label></h4>
            <textarea class="form-control  @error('content') is-invalid @enderror" id="content" rows="8" name="content" placeholder="Describe your project..." required> {{ old('content', $project->content) }} </textarea>
            @error('content')
                <div class="text-danger p-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- checkboxes -->
        <div>
            @foreach($technologies as $technology)
            <input type="checkbox" value="{{$technology->id}}" id="tag-{{$technology->label}}" name="technologies[]"
             @if(in_array($technology->id, old('technologies', $project_technologies ?? []))) checked @endif>
            <label class="me-2" for="tag-{{$technology->label}}">
                {{$technology->label}}
            </label>
            @endforeach
            @error('technologies')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <?php #buttons ?>
        <div class="mt-5">
            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-upload me-2"></i>{{ $project->exists ? 'Update' : 'Upload'}}</button>
        <div>
    </form>
    @if(Route::is('admin.projects.edit'))
    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
    @csrf
    @method('DELETE')
        <button id="btn-delete" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this project?')"><i class="fa-solid fa-trash-can"></i></button>
    </form>
    @endif

</main>