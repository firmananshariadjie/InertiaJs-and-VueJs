<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\SkillResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Skill;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = SkillResource::collection(Skill::all());
        return Inertia::render('Skills/Index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Skills/Create');
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
            'image' => 'required|image'
        ]);

        if ($req->hasFile('image')) {
            $image = $req->file('image')->store('skills');
            Skill::create([
                'name' => $req->name,
                'image' => $image
            ]);
            return Redirect::route('skills.index')->with('message', 'Project Created Successsfully.');
        };
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return Inertia::render('Skills/Edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Skill $skill)
    {
        $image = $skill->image;
        $req->validate([
            'name' => 'required'
        ]);

        if ($req->hasFile('image')) {
            Storage::delete($skill->image);
            $image = $req->file('image')->store('skills');
        }

        $skill->update([
            'name' => $req->name,
            'image' => $image
        ]);

        return Redirect::route('skills.index')->with('message', 'Project Updated Successsfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        Storage::delete($skill->image);
        $skill->delete();
        return Redirect::back()->with('message', 'Project Deleted Successsfully.');
    }
}
