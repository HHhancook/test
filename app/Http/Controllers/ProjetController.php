<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\Task;


class ProjetController extends Controller
{

   
    public function addProject(Request $request)
    {
        try {
            $projet =  Projet::create([
                'name' => $request->name,
                'user_id' => $request->user_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'successfully!',
                'data' => $projet
            ]);    
        } catch (\Throwable $th) {
            \Log::error($th);
        }
    }

    public function getProjet($user_id)
    {
        try {
            $projets = [];
            $task = Task::where('user_id',$user_id)
            ->with('projet')->get();

            foreach($task as $row){
                
                array_push($projets,[
                    'name' => $row->projet->name,
                    'id' => $row->projet->id,
                ]);
            }
            return ['success' => true, 'data' => collect($projets)->unique('id')->values()->all() ];

        } catch (\Throwable $th) {
            \Log::error($th);
        }
    }

    public function getProjetById($projet_id)
    {
        try {
            $data = Task::where('projet_id',$projet_id)->with('user')->get();
            
            return ['success' => true, 'data' => $data];
        } catch (\Throwable $th) {
            \Log::error($th);
        }

    }
}
