<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Projects;
use App\Models\ProjectParticipant;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    /*
    // show all projects on specific category
    public function index(int $id)
    {
        $projects = null;

        if (Auth::check()) {
            $projects = Projects::where(function($query) use ($id) {
                $query->where('privacy', 'public')
                    ->orWhereIn('id', ProjectParticipant::where('user_id', Auth::id())->pluck('project_id')->toArray());
            })
            ->where('category_id', $id)
            ->get(); 
        } else {
            $projects = Projects::where('privacy', 'public')
                        ->where('category_id', $id)
                        ->get();
        }

        $categoryName = Category::where('id', $id)->pluck('name')->first();
        
        return view('projects', ['projects' => $projects, 'categoryName' => $categoryName]);
    }
    */
    
    // show detail of task
    public function show(int $proj_id, int $id)
    {
        $task = Task::find($id);
        $privacy = $task->privacy;
        $assign_to = $task->user_id;

        $user = User::find($assign_to);
        $project = Projects::find($proj_id);

        if(Auth::check() && (Auth::id() == $assign_to || Auth::id() == $project->leader_id))
        {
            if(Auth::id() == $assign_to && $task->status == 'pending')
            {
                //Update Status
                Task::where('id',$id)->update([
                    'status' => 'in progress',
                ]);
            }
            return view('viewTask', ['task' => $task, 'user'=>$user, 'proj_id'=>$proj_id]);
        }
        else if($privacy == 'public')
        {
            return view('viewTask', ['task' => $task, 'user'=>$user, 'proj_id'=>$proj_id]);
        }
        else
        {
            return redirect()->route('viewProject',['id' => $proj_id])->with('status', 'The Task Only Visible to Leader and Assigned User');
        } 
    }

    public function markAsComplete(int $proj_id, int $id)
    {
        $task = Task::find($id);
        $assign_to = $task->user_id;

        if(Auth::check() && Auth::id() == $assign_to)
        {
            //Update Status
            Task::where('id',$id)->update([
                'status' => 'completed',
            ]);
            return redirect()->route('viewTask',['proj_id' => $proj_id, 'id' => $proj_id])->with('status', 'Marked Completed for the Task');
        }
        return redirect()->route('viewTask',['proj_id' => $proj_id, 'id' => $proj_id])->with('status', 'Only Assigned User can Mark as Complete');
    }
 
    // create task
    public function create(int $id)
    {
        $users = User::whereIn('id', function($query) use ($id) {
            $query->select('user_id')
                  ->from('project_participants')
                  ->where('project_id', $id);
        })->get();
        
        return view('addTask', ['users'=> $users, 'proj_id'=>$id]);
    }

    
    // store Task
    public function store(Request $request, int $id)
    { 
        $value = $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required',
            'privacy' => 'required|in:public,private',
            'due_date' => 'required',
            'project_id' => 'required',
        ]);

        $project = Projects::find($id);  // Find the project by its ID
        $leader_id = $project->leader_id;

        if(Auth::check() && Auth::id() == $leader_id)
        {
            Task::create([
                'name' => $request->name,
                'description' => $request->description,
                'project_id' => $request->project_id,  // Ensure the project ID is passed here
                'user_id' => $request->user_id,
                'status' => 'pending',
                'privacy' => $request->privacy,
                'due_date' => $request->due_date,
            ]);
    
            return redirect()->route('addTask', ['id'=>$id])->with('status','The Task is created Successfully ');
        }
        else
        {
            return redirect()->route('addTask', ['id'=>$id])->with('status','Only Project Leader can Create Task');
        }
    }

    public function myTasks()
    {
        if(Auth::guest())
        {
            return redirect()->route('login');
        }

        $id = Auth::id();

        $tasks = Task::where('user_id', $id)->orderBy('id', 'desc')->get();
        $users = User::all()->pluck('name', 'id');

        return view('myTasks',['tasks'=>$tasks, 'users'=>$users]);
    }

    /*
    //edit category detail detail
    public function edit(int $id)
    {
        $member = Member::find($id);

        return view('update_member',['member'=>$member]);
    }

    // update category
    public function update(Request $request,int $id)
    {
        $request->validate([
            'name'=>'required | max:255 | string',
            'description'=>'required | max:255 | string',
            'image'=> 'nullable | mimes:png,jpg,jpeg'
        ]);

        // To delete previous image from storage
        $member = Member::find($id);
        $image = $member->image;
        if($request->has('image'))
        {
            if(File::exists($member->image))
            {
                File::delete($member->image); //delete image from storage
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $path = 'uploads/member/';
            $file->move($path, $file_name);
            $image = $path.$file_name;
        }

        Member::where('id',$id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);

        return redirect()->route('update',$id)->with('status','Member Information Updated Successfully');
        
    }

    // delete category
    public function destroy(Request $request)
    {
        $id = $request->id;
        $member = Member::find($id);

        if(File::exists($member->image))
        {
            File::delete($member->image); //delete image from storage
        }

        Member::destroy($id);

        return redirect()->route('home')->with('status','Member Deleted Successfully');
    }
    */
}
