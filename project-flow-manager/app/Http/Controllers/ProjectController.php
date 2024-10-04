<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Projects;
use App\Models\ProjectParticipant;
use App\Models\User;
use App\Models\Task;

class ProjectController extends Controller
{
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

    //show all project
    public function indexAll()
    {
        $projects = null;

        if (Auth::check()) {
            $projects = Projects::where(function($query) {
                $query->where('privacy', 'public')
                    ->orWhereIn('id', ProjectParticipant::where('user_id', Auth::id())->pluck('project_id')->toArray());
            })
            ->get()->sortByDesc('id'); 
        } else {
            $projects = Projects::where('privacy', 'public')
                        ->get()
                        ->sortByDesc('id');
        }
        
        return view('allProjects', ['projects' => $projects]);
    }

    //show all project
    public function indexMy()
    {
        if (Auth::check()) {
            $projects = Projects::where(function($query) {
                $query->WhereIn('id', ProjectParticipant::where('user_id', Auth::id())->pluck('project_id')->toArray());
            })
            ->get()->sortByDesc('id'); 

            return view('myProjects', ['projects' => $projects]);
        } else {
            return redirect()->route('login');
        }
        
        
    }

    
    // show detail of project
    public function show(int $id)
    {
        $project = null;

        if (Auth::check()) 
        {// If the user is authenticated
            $project = Projects::where(function($query) use ($id) {
                $query->where('id', $id)
                    ->where('privacy', 'public');
            })
            ->orWhereIn('id', ProjectParticipant::where('user_id', Auth::id())->pluck('project_id')->toArray())
            ->first();
        } 
        else 
        { // If the user is not authenticated, only public projects are available
            $project = Projects::where('id', $id)
                    ->where('privacy', 'public')
                    ->first();
        }

        if ($project == null) {
            return redirect()->route('login');
        }

        $leader_id = $project->leader_id;
        $leader = User::where('id', $leader_id)->first();

        $tasks = Task::where('project_id', $id)->get();

        $users = User::all()->pluck('name', 'id');

        $totalCount = Task::where('project_id', $id)->count();
        $totalCompleteCount = Task::where('project_id', $id)->where('status', 'completed')->count();
        $completedPercentage = $totalCount > 0 ? ($totalCompleteCount / $totalCount) * 100 : 0;
        $completedPercentage = round($completedPercentage);

        return view('viewProject', ['project' => $project, 'leader'=> $leader, 'project_id' => $id, 'tasks'=>$tasks, 'users'=>$users, 'percentage'=>$completedPercentage]);
    }

    

    // create project
    public function create()
    {
        if(Auth::check())
        {
            $category = Category::all();

            return view('addProject',['categories'=>$category]);
        }    
        else
            return redirect()->route('login');;
    }


    // store project
    public function store(Request $request)
    {
        $value = $request->validate([
            'name' => 'required|max:255|string|unique:projects,name',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'privacy' => 'required|in:public,private',
            'category_id' => 'required|exists:categories,id',
        ]);

        $file_name = null; // Initialize file_name as null
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extension;
            $path = 'uploads/projects/';
            $file->move($path, $file_name);
        }

        $project = Projects::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $file_name ? $path . $file_name : null,
            'privacy' => $request->privacy,
            'leader_id' => Auth::id(),
            'category_id' => $request->category_id,
        ]);

        $project_id = $project->id;

        //adding to participants
        ProjectParticipant::create([
            'project_id' => $project_id,
            'user_id' => Auth::id(),
        ]);

        //return redirect()->route('addProject')->with('status','The Project created Successfully');
        return redirect()->route('myprojects')->with('status','The Project created Successfully');
    }

    // update Project
    public function updateWindow(int $id)
    {

        if (Auth::check()) 
        {// If the user is authenticated as leader
            $project = Projects::where(function($query) use ($id) {
                $query->where('id', $id);
            })
            ->where('leader_id', Auth::id()) // Chained 'where' for AND condition
            ->first();

            if($project)
            {
                $category = Category::all();

                return view('updateProject', ['project' => $project, 'categories' => $category, 'selectedPrivacy' => $project->privacy, 'selectedCategory' => $project->category_id]);
            }
        } 

        $project = Projects::where('id', $id)->first();

        $leader_id = $project->leader_id;
        $leader = User::where('id', $leader_id)->first();

        $tasks = Task::where('project_id', $id)->get();

        $users = User::all()->pluck('name', 'id');

        $totalCount = Task::where('project_id', $id)->count();
        $totalCompleteCount = Task::where('project_id', $id)->where('status', 'completed')->count();
        $completedPercentage = $totalCount > 0 ? ($totalCompleteCount / $totalCount) * 100 : 0;
        $completedPercentage = round($completedPercentage);

        return redirect()->route('viewProject', $id)->with('status','Only leader can update the Project');
    }

    public function makeUpdateProject(Request $request, int $id)
    {
        $project = Projects::where('id', $id)->first();

        $value = $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'privacy' => 'required|in:public,private',
            'category_id' => 'required|exists:categories,id',
        ]);

        // To delete previous image from storage

        if ($request->hasFile('image')) {
            // Check if the current image exists and delete it
            if (!empty($project->image) && File::exists(public_path($project->image))) {
                File::delete(public_path($project->image)); // Delete the old image
            }
            
            // Store the new image
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extension;
            $path = 'uploads/projects/';
            $file->move(public_path($path), $file_name);
            $image = $path . $file_name;

            // Add new image path to validated data
            $value['image'] = $image;
        }

        $project->update($value);

        return redirect()->route('viewProject', $id)->with('status', 'The Project updated Successfully');
    }

    public function deleteProject(int $id)
    {
        if (Auth::check()) 
        {// If the user is authenticated as leader
            $project = Projects::where(function($query) use ($id) {
                $query->where('id', $id);
            })
            ->where('leader_id', Auth::id()) // Chained 'where' for AND condition
            ->first();

            if (!empty($project->image) && File::exists(public_path($project->image))) {
                File::delete(public_path($project->image)); // Delete the image from the server
            }
        
            // Delete the project from the database
            $project->delete();

            return redirect()->route('myprojects')->with('status', 'The project deleted successfully');
        } 

        $project = Projects::where('id', $id)->first();

        $leader_id = $project->leader_id;
        $leader = User::where('id', $leader_id)->first();

        $tasks = Task::where('project_id', $id)->get();

        $users = User::all()->pluck('name', 'id');

        $totalCount = Task::where('project_id', $id)->count();
        $totalCompleteCount = Task::where('project_id', $id)->where('status', 'completed')->count();
        $completedPercentage = $totalCount > 0 ? ($totalCompleteCount / $totalCount) * 100 : 0;
        $completedPercentage = round($completedPercentage);

        return redirect()->route('viewProject', $id)->with('status','Only leader can delete the Project');
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

    public function indexParticipant(int $id)
    {
        $users = User::whereNotIn('id', function($query) use ($id) {
            $query->select('user_id')
                  ->from('project_participants')
                  ->where('project_id', $id);
        })->get();

        $added_users = User::whereIn('id', function($query) use ($id) {
            $query->select('user_id')
                  ->from('project_participants')
                  ->where('project_id', $id);
        })->get();

        return view('addProjectParticipant', ['users'=>$users, 'project_id'=>$id, 'added_users'=>$added_users]);
    }

    public function storeParticipant(int $proj_id, int $user_id)
    {
        $project = Projects::find($proj_id);
        $leader_id = 0;

        if($project)
        {
            $leader_id = $project->leader_id;
        }

        if(Auth::check() && Auth::id() == $leader_id)
        {
            ProjectParticipant::create([
                'project_id' => $proj_id,
                'user_id' => $user_id,
            ]);
            
            return redirect()->route('addProjectUser', ['id' => $proj_id]) ->with('status','The Participant Successfully added to Project');
        }
        else
        {
            return redirect()->route('addProjectUser', ['id' => $proj_id])
                                ->with('status', 'Only Project Leader Can Add Participant');
        } 
    }

    public function removeParticipant(int $proj_id, int $user_id)
    {
        $project = Projects::find($proj_id);
        $leader_id = 0;

        if($project)
        {
            $leader_id = $project->leader_id;
        }

        if(Auth::check() && Auth::id() == $leader_id)
        {
            if($leader_id == $user_id)
            {
                return redirect()->route('addProjectUser', ['id' => $proj_id]) ->with('status','The Leader can not be removed from Project');
            }
            
            $participant = ProjectParticipant::where('project_id', $proj_id)
                                 ->where('user_id', $user_id)
                                 ->first();

            // Get all tasks assigned to the user who is being removed from the project
            $tasks = Task::where('project_id', $proj_id)
                    ->where('user_id', $user_id)
                    ->get(); // Use get() to retrieve all matching tasks

            // Change the user of each task from the current user to the project leader
            foreach ($tasks as $task) {
                $task->update(['user_id' => $leader_id]);
            }
            $participant->delete();

            return redirect()->route('addProjectUser', ['id' => $proj_id]) ->with('status','The Participant Successfully removed from Project');
        }
        else
        {
            return redirect()->route('addProjectUser', ['id' => $proj_id])
                                ->with('status', 'Only Project Leader Can Remove Participant');
        } 

    }
}
