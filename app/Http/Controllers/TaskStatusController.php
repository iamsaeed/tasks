<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\Project;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
    public function add(Request $request)
    {
        if(!$request->input('id'))
        {
            $message = 'Task Status added!';

            $request->validate([
                'name' => 'required|unique:task_statuses,name'
            ]);
        } else {
            $message = 'Task Status updated!';

            $request->validate([
                'name' => 'required|unique:task_statuses,name,'.$request->input('id')
            ]);
        }

        $task_status = TaskStatus::updateOrCreate(
            [ 'id' => $request->input('id') ],
            [
                'name' => $request->input('name'),
                !$request->input('id') ? 'created_by' : 'updated_by' => Auth::id()
            ]
        );

        $this->processResponse('task_statuses', $task_status, $message);
    }

    public function get()
    {
        $task_statuses = TaskStatus::orderBy('name', 'asc')->get();

        return $this->processResponse('task_statuses', $task_statuses);
    }

    public function getActive()
    {
        $task_statuses = TaskStatus::orderBy('name', 'asc')->active()->get();

        return $this->processResponse('task_statuses', $task_statuses);
    }
}
