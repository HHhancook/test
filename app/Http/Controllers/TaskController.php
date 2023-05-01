<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{

    public function addTask(Request $request)
    {
        try {

            $task = new Task();
            $task->title = $request->input('titre');
            $task->description = $request->input('description');
            $task->user_id = $request->input('user_id');
            $task->projet_id = $request->input('projet_id');
            $task->save();

            return ['success' => true];
        } catch (\Throwable $th) {
            \Log::error($th);
        }

    }

    public function updateType($statut,$id){

        $task = Task::find($id);
        $task->statut = $statut;
        $task->save();

    }
    
    public function suivantPrecedent(Request $request)
    {
        try {
       
            $data = $request->all();

            if($data['statut'] == 'a_faire'){
                $this->updateType('test',$data['id']);
            }
            else if ($data['statut'] == 'termin'){
                $this->updateType('test',$data['id']);
            }
            else {

                if($data['type'] == 'suivant'){
                    $this->updateType('termin',$data['id']);
                }
                else{
                    $this->updateType('a_faire',$data['id']);
                }        
            }

        return ['success' => true];
        } catch (\Throwable $th) {
            \Log::error($th);
        }
     

    }

    public function updateTask(Request $request)
    {
        try {

            $task = Task::find($request->id);
            $task->name = $request->input('titre');
            $task->date_debut = $request->input('description');
            $task->user_id = $request->input('user_id');
            $task->save();

            return ['success' => true];
        } catch (\Throwable $th) {

            \Log::error($th);


        }
    
    }

    public function deleteTask(Request $request)
    {
        try {

            $task = Task::find($request->id);
            $task->delete();

            return ['success' => true];
        } catch (\Throwable $th) {
            \Log::error($th);
        }
    }

}
