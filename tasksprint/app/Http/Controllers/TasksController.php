<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task ;
use App\Traits\JsonResponse ;

class TasksController extends Controller
{

    use JsonResponse;


    public function index(){

        $tasks = Task::where('user_id', auth()->id())->get();

        return $this->successResponse([
            'tasks' => $tasks
        ], 'Tasks retrieved successfully' , 200);
    }


    public function store(CreateTaskRequest $request)
    {
        $validatedData = $request->validated();


        $task = Task::create($validatedData);


        return $this->successResponse([

            'task' => $task
        ], 'Task created successfully', 201);
    }

    public function  update(CreateTaskRequest $request, Task $task)
    {
        $validatedData = $request->validated();

        $task->update($validatedData);


        return $this->successResponse([
            'task' => $task
        ], 'Task updated successfully',
    200
    );
    }


    public function destroy(Task $task)
    {
        $task->delete();

        return $this->successResponse([], 'Task deleted successfully', 200);
    }




}

