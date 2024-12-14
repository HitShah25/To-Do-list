<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Todocontroller extends Controller
{
    //
    public function create()
    {
        return view('create');
    }
    public function show(Request $request)
    {
        // Get the filter query parameter, default to 'pending'
        $filter = $request->query('filter', 'pending');
    
        // If 'all' is selected, show both pending and completed todos for the authenticated user
        if ($filter == 'all') {
            $todos = Todo::where('user_id', Auth::id())->get();
        } else {
            // Show only pending todos (completed == 0) by default
            $todos = Todo::where('user_id', Auth::id())->where('completed', 0)->get();
        }
    
        return view('showtodo', ['todos' => $todos, 'filter' => $filter]);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'task_name'=>'required',
            'user_id'=>'required',
            'description'=>'required',
            'completed'=>'required',
            'photo'=>'nullable|mimes:jpeg,jpg,png,gif'

        ]);
        $todo=Todo::where('id',$id)->where('user_id',Auth::id())->first();

        //update img
        if(isset($request->photo))
        {
        $imgname=time().'.'.$request->photo->extension();
        $request->photo->move(public_path('images'),$imgname);
        $todo->image=$imgname;
        }

        $todo->name=$request->task_name;
        $todo->description=$request->description;
        $todo->completed=$request->completed;
        $todo->save();
        // return back()->withSuccess('List added');
        return redirect('/show');
        
        
    }
    public function store(Request $request)
    {        

        $todo= new Todo;
        if(isset($request->photo))
        {
            //upload img
            $imgname=time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'),$imgname);
            $todo->image=$imgname;
        }


        $todo->name=$request->task_name;
        $todo->user_id=$request->user_id;
        $todo->description=$request->description;
        $todo->save();
        // return back()->withSuccess('List added');
        return redirect('/show');
    }
    public function delete($id)
    {
        $todo=Todo::where('id',$id)->where('user_id',Auth::id())->first();
        $todo->delete();
        return redirect('/show');

    }
    public function edit($id)
    {
        
    $todo=Todo::where('id',$id)->where('user_id',Auth::id())->first();
     return view('edit',['todo'=>$todo]);    
    }
    public function view($id)
    {
        $todo=Todo::where('id',$id)->where('user_id',Auth::id())->first();
        return view('view',['todo'=>$todo]);
    }

}
