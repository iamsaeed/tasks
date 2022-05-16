<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
               'task_status_id' => $request->input('task_status_id'),
               'project_id' => $request->input('project_id'),
               'ends_at' => $request->input('ends_at'),
               'priority' => $request->input('priority'),
               !$request->input('id') ? 'created_id' : 'updated_id' => Auth::id()
           ]
       );

       $this->processResponse('task', $task, $message);
   }

   public function show(Task $task)
   {
        abort_if(Auth::id() !== $task->created_id, 404);

        return view('task_show', [
            'task' => $task
        ]);
   }

   public function getTask(Task $task)
   {
        $t = Task::where('id', $task->id)
            ->withCount('images')
            ->with(['created_by', 'status', 'project', 'images', 'comments'])
            ->first();

        return $this->processResponse('task', $t);
   }

   public function destroy(Request $request, ImageController $controller)
   {
       $task = Task::find($request->input('id'));

       DB::beginTransaction();
       // delete images
       if($task->images->count())
       {
           foreach($task->images as $image)
           {
               $controller->deleteSingleImage($image->id, '/images/attachments/');
           }
       }

       // delete comments and their replies
       if($task->all_comments->count())
       {
           $task->all_comments()->delete();
       }

       // delete
       $task->delete();
       DB::commit();

       return $this->processResponse(null, null, 'Task deleted!');
   }
}
