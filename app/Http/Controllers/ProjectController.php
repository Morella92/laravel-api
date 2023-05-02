<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Typology;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::withTrashed()->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typologies = Typology::orderBy('name', 'asc')->get();
        $technologies =Technology::orderBy('name')->get();

        return view('projects.create', compact('typologies', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated(); //richiama la form request validation

        $data['slug'] = Str::slug($data['title']);

        $project = Project::create($data);

        if (isset($data['technologies'])) {
            $project->technologies()->attach($data['technologies']);
        }


        return to_route('projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $typologies = Typology::orderBy('name', 'asc')->get();
        $technologies =Technology::orderBy('name')->get();

        return view('projects.edit', compact('project', 'typologies', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request-validated();

        $data['slug'] = Str::slug($data['title']);

        $project->update($data);

        if (isset($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }


        return to_route('projects.show', $project);
    }

    public function restore(Project $project){

        if($project->trashed()){ //controllo che sia stato effettivamente cancellato
            $project->restore(); //metodo restore per ripristinare
        }

        return back(); //riporta alla pagina precedente rispetto alla chiamata
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->trashed()){

            $project->forceDelete(); //eliminazione definitiva

        }else{

            $project->delete(); // eliminazione soft
        }
        

        return to_route('projects.index');
    }
}
