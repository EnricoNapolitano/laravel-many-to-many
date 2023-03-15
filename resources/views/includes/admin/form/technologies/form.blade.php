@include('includes.alerts.error')


@if($technology->exists)
<!-- form edit -->
<form action="{{route('admin.technologies.update', $technology->id)}}" method="POST">
@method('PUT')

@else
<!-- form upload -->
<form action="{{route('admin.technologies.store')}}" method="POST">
@endif 

    @csrf
    <div class="row my-5">
        <!-- Input to choose label -->
        <div class="col">
            <h4><label class="form-label" for="technology-label">Technology</label></h4>
            <input class="form-control @error('label') is-invalid @enderror" placeholder="Write a technology" type="text" id="technology-label" value="{{ old('label', $technology->label) }}" name="label">
            @error('label')
            <div class="text-danger p-1">{{ $message }}</div>
            @enderror
        </div>
    
        <!-- Input to choose class icon -->
        <div class="col">
            <h4><label class="form-label" for="technology-class">CSS class</label></h4>
            <input class="form-control @error('class_icon') is-invalid @enderror" placeholder="Write a CSS class" type="text" id="technology-class" value="{{ old('class_icon', $technology->class_icon) }}" name="class_icon">
            @error('class_icon')
            <div class="text-danger p-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-upload me-2"></i>{{ $technology->exists ? 'Update' : 'Upload'}}</button>

</form>

@if(Route::is('admin.technologies.edit'))
<form action="{{route('admin.technologies.destroy', $technology->id)}}" method="POST" id="btn-delete">
    @csrf
    @method('DELETE')
    <button class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this technology?')"><i class="fa-solid fa-trash-can"></i></button>
</form>
@endif