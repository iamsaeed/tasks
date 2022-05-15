<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
   public function get()
   {
       $tasks = Task::where('created_id', Auth::id())
           ->where('created_id', Auth::id())
           ->with(['created_by'])
           ->orderBy('created_at', 'desc')
           ->get();

       return $this->processResponse('tasks', $tasks);
   }

   public function add(Request $request)
   {
       $request->validate([
           'title' => 'required',
           'project_id' => 'required',
       ]);

       $message = !$request->input('id') ? 'Task added!' : 'Task updated!';

       $task = Task::updateOrCreate(
           [ 'id' => $request->input('id') ],
           [
               'title' => $request->input('title'),
               'description' => $request->input('description') ?? null,
               'project_id' => $request->input('project_id'),
               !$request->input('id') ? 'created_by' : 'updated_by' => Auth::id()
           ]
       );

       $this->processResponse('task', $task, $message);
   }
}
