<?php

namespace App\Http\Controllers;

use App\Constants\AC;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
   public function add(Request $request)
   {
       if(!$request->input('id'))
       {
           $message = 'Project added!';

           $request->validate([
               'name' => 'required|unique:projects,name'
           ]);
       } else {
           $message = 'Project updated!';

           $request->validate([
               'name' => 'required|unique:projects,name,'.$request->input('id')
           ]);
       }

        $project = Project::updateOrCreate(
            [ 'id' => $request->input('id') ],
            [
                'name' => $request->input('name'),
                !$request->input('id') ? 'created_id' : 'updated_id' => Auth::id()
            ]
        );

        $this->processResponse('project', $project, $message);
   }

   public function get()
   {
       $projects = Project::orderBy('name', 'asc')->where('created_id', Auth::id())->get();

       return $this->processResponse('projects', $projects);
   }

    public function getActive()
    {
        $projects = Project::orderBy('name', 'asc')
            ->where('created_id', Auth::id())
            ->where('status', AC::_ACTIVE)
            ->get();

        return $this->processResponse('projects', $projects);
    }
}
