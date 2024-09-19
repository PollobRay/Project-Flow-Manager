<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // show all category
    public function index()
    {
        $category = Category::all();
        
        return view('category',['categories'=>$category]);
    }

    /*
    // show detail of category
    public function show(int $id)
    {
        $member = Category::find($id);

        return view('view_member',['member'=>$member]); 
    }
        */

    // create category
    public function create()
    {
        if(Auth::check())
            return view('addCategory');
        else
            return redirect()->route('login');
    }

    
    // store category
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required | max:255 | string |unique:categories,name',
            'description'=>'required | max:255 | string',
            'image'=> 'required | mimes:png,jpg,jpeg'
        ]);

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $file_name = time().'.'.$extension;
        $path = 'uploads/category/';
        $file->move($path, $file_name);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path.$file_name
        ]);

        return redirect()->route('addCategory')->with('status','The Category Added Successfully');
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
