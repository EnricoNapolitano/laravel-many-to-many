<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::orderBy('created_at')->get();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technology = new Technology();
        return view('admin.technologies.create', compact('technology'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|unique:technologies|min:3|max:10',
            'class_icon' => 'string|nullable',
        ], [
            'label.required' => 'Label is required',
            'class_icon.string' => 'Input value has to be a text',
        ]);

        $data = $request->all();
        
        $technology = new Technology();
        
        $technology->fill($data);
        
        $technology->save();

        return to_route('admin.technologies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'label' => 'required|string|unique:technologies|min:3|max:10',
            'class_icon' => 'string|nullable',
        ], 
        [
            'label.required' => 'Label is required',
            'class_icon.string' => 'Write a text',
        ]);

        $data = $request->all();
        
        // $technology = new Technology();
        
        $technology->fill($data);
        
        $technology->save();

        return to_route('admin.technologies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        // removing relation between technology and project
        $technology->projects()->detach();

        // removing technology from database
        $technology->delete();

        return to_route('admin.technologies.index');
    }
}
