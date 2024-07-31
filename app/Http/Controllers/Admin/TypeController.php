<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        //dd($types);
        return view('admin.types.index', compact('types'), ['types' => Type::orderBy('id')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {

        //dd($request->all());

        $validated = $request->validated();

        $slug = Str::slug($request->name, '-');
        $validated['slug'] = $slug;

        if ($request->has('cover_image')) {
            $image_path = Storage::put('uploads', $validated['cover_image']);
            //dd($validated, $image_path);
            $validated['cover_image'] = $image_path;
        }

        Type::create($validated);

        return to_route('admin.types.index')->with('message', 'Project Create Sucessufully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $validated = $request->validated();

        $slug = Str::slug($request->name, '-');
        $validated['slug'] = $slug;

        if ($request->has('cover_image')) {

            if ($type->cover_image) {
                Storage::delete($type->cover_image);
            }

            $image_path = Storage::put('uploads', $validated['cover_image']);
            //dd($validated, $image_path);
            $validated['cover_image'] = $image_path;
        }

        $type->update($request->all());

        return to_route('admin.types.show', $type)->with('message', 'Project Update Sucessufully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('message', "Type $type->name deleted successfully");
    }
}
