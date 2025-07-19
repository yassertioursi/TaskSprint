<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Traits\JsonResponse;
use Carbon\Carbon;

class TasksController extends Controller
{
    use JsonResponse;

    public function index(Request $request)
    {


        $query = Task::where('user_id', auth()->id());


        if ($request->has('date') && $request->filled('date')) {
            $date = $request->input('date');

            try {
                $parsedDate = Carbon::parse($date)->format('Y-m-d');
                $query->whereDate('created_at', $parsedDate);
            } catch (\Exception $e) {
                return $this->failResponse('Invalid date format. Please use YYYY-MM-DD format.', 400);
            }
        }

        $tasks = $query->get();

        return $this->successResponse([
            'tasks' => $tasks,
            'filter' => $request->has('date') ? ['date' => $request->input('date')] : null
        ], 'Tasks retrieved successfully', 200);
    }

    public function store(CreateTaskRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();

        $task = Task::create($validatedData);

        return $this->successResponse([
            'task' => $task
        ], 'Task created successfully', 201);
    }

    public function update(CreateTaskRequest $request, Task $task)
    {
        // Check if the task belongs to the authenticated user
        if ($task->user_id !== auth()->id()) {
            return $this->failResponse('Unauthorized to update this task', 403);
        }

        $validatedData = $request->validated();
        $task->update($validatedData);

        return $this->successResponse([
            'task' => $task
        ], 'Task updated successfully', 200);
    }

    public function destroy(Task $task)
    {
        // Check if the task belongs to the authenticated user
        if ($task->user_id !== auth()->id()) {
            return $this->failResponse('Unauthorized to delete this task', 403);
        }

        $task->delete();

        return $this->successResponse([], 'Task deleted successfully', 200);
    }
}

