<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Project::all());
        $types = Type::all();
        return view('admin.projects.index', compact('types'), ['projects' => Project::orderByDesc('id')->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request, Faker $faker)
    {
        //dd($request->all());
        //validiamo
        $validated = $request->validated();

        //$slug = $request->title;
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;
        //dd($slug);

        if ($request->has('cover_image')) {
            $image_path = Storage::put('uploads', $validated['cover_image']);
            //dd($validated, $image_path);
            $validated['cover_image'] = $image_path;
        }
        //creiamo


        $project = Project::create($validated);



        if ($request->has('technologies')) {
            $project->technologies()->attach($validated['technologies']);
        }

        //reindiriziamo
        return to_route('admin.projects.index')->with('message', 'Project Create Sucessufully');
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
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //dd($request->all());
        $validated = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        if ($request->has('cover_image')) {

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $image_path = Storage::put('uploads', $validated['cover_image']);
            //dd($validated, $image_path);
            $validated['cover_image'] = $image_path;
        }

        if ($request->has('technologies')) {
            $project->technologies()->sync($validated['technologies']);
        }

        $project->update($validated);

        return to_route('admin.projects.index')->with('message', 'Project Update Sucessufully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('message', "Project $project->name deleted successfully");
    }
}
