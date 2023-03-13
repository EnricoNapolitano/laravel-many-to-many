<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::orderBy('label')->get();
        return view('admin.projects.create', compact('project'), compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:projects|min:5|max:50',
            'type_id' => 'nullable|exists:types,id',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ], [
            'title.required' => 'Title is required',
            'type_id' => 'Choose the project type',
            'title.unique' => 'This title has already been taken',
            'title.min' => 'Title has has to be minimun 5 letters',
            'title.max' => 'Title has has to be maximum 50 letters',
            'content.required' => 'Content can\'t be empty',
            'image.image' => 'Files need to be an image',
            'image.mimes' => 'Accepted extensions are: jpg, jpeg, png',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');
        
        $project = new Project();
        
        $project->fill($data);
        
        // Storing image and creating its path
        if ($request->hasFile('image')) $project->image = Storage::put('upload', $data['image']);
        
        $project->save();

        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('label')->get();
        return view('admin.projects.edit', compact('project'), compact('types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required','string',Rule::unique('projects')->ignore($project->id),'min:5','max:50'],
            'type_id' => 'nullable|exists:types,id',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ], [
            'title.required' => 'Title is required',
            'type_id' => 'Choose the project type',
            'title.unique' => 'This title has already been taken',
            'title.min' => 'Title has has to be minimun 5 letters',
            'title.max' => 'Title has has to be maximum 50 letters',
            'content.required' => 'Content can\'t be empty',
            'image.image' => 'Files need to be an image',
            'image.mimes' => 'Accepted extensions are: jpg, jpeg, png',
        ]);
        
        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');
        
        $project->fill($data);
        
        if ($request->hasFile('image')){
            if($project->image) Storage::delete($project->image);
            $project->image = Storage::put('upload', $data['image']);
        } 
        
        $project->save();

        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if($project->image) Storage::delete($project->image);

        $project->delete();
        return to_route('admin.projects.index');
    }
}
