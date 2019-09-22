<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;

class apiController extends Controller
{
    public function getTask(){
         
        return task::where('status','0')->get();
    }

    public function addtask(Request $request){

        return Task::create($request->all());
    }

    public function doneTask($id){
        //echo $id;
        //$task = task::findOrFail($id);
        $t = task::where('id',$id)
                ->update(['status'=>1]);
        

    }

    public function deleteTask($id){
         echo $id;
        $task = task::findOrFail($id);
        $task->delete();
       
         
    }
}
