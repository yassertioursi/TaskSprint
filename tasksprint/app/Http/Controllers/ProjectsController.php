<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project ;
use App\Traits\JsonResponse ;

class ProjectsController extends Controller
{

    use JsonResponse;


    public function index(){

        $projects = Project::where('user_id', auth()->id())->get();

        return $this->successResponse([
            'projects' => $projects
        ], 'Projects retrieved successfully' , 200);
    }


    public function store(CreateProjectRequest $request)
    {
        $validatedData = $request->validated();


        $project = Project::create($validatedData);


        return $this->successResponse([

            'project' => $project
        ], 'Project created successfully', 201);
    }

    public function  update(CreateProjectRequest $request, Project $project)
    {
        $validatedData = $request->validated();

        $project->update($validatedData);


        return $this->successResponse([
            'project' => $project
        ], 'Project updated successfully',
    200
    );
    }


    public function destroy(Project $project)
    {
        $project->delete();

        return $this->successResponse([], 'Project deleted successfully', 200);
    }




}

