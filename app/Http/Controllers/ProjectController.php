<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = ProjectResource::collection(Project::with('skill')->get());
        return Inertia::render('Projects/Index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skills = Skill::all();
        return Inertia::render('Projects/Create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'image' => 'required|image',
            'skill_id' => 'required',
        ]);

        if ($req->hasFile('image')) {
            $image = $req->file('image')->store('projects');
            Project::create([
                'name' => $req->name,
                'image' => $image,
                'skill_id' => $req->skill_id,
                'proeject_url' => $req->proeject_url
            ]);
            return Redirect::route('projects.index')->with('message', 'Project Created Successsfully.');
        };
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $skills = Skill::all();
        return Inertia::render('Projects/Edit', compact('project', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Project $project)
    {
        $image = $project->image;
        $req->validate([
            'name' => 'required',
            'skill_id' => 'required',
        ]);

        if ($req->hasFile('image')) {
            Storage::delete($project->image);
            $image = $req->file('image')->store('projects');
        }

        $project->update([
            'name' => $req->name,
            'image' => $image,
            'proeject_url' => $req->proeject_url,
            'skill_id' => $req->skill_id
        ]);

        return Redirect::route('projects.index')->with('message', 'Project Updated Successsfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        Storage::delete($project->image);
        $project->delete();
        return Redirect::back()->with('message', 'Project Deleted Successsfully.');
    }
}
