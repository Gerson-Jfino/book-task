<?php

namespace App\Http\Controllers\Incident;

use App\Models\Incident;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    private $incident;
    public function __construct(Incident $incident) {
        $this->incident = $incident;
    }
    public function index() {
        $incidents = $this->incident->with('user')->get()->map(function ($inc) {
            return [
                "id" => $inc->id,
                "start" => $inc->start,
                "end" => $inc->end,
                "incident" => $inc->incident,
                "description" => $inc->description,
                "resolution" => $inc->resolution,
                "created_at" => $inc->created_at,
                "user" => $inc->user_id ? $inc->user->name : "",

            ];
        });
        return response()->json($incidents, 200);
    }
    public function store(Request $request) {
        
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        DB::beginTransaction();
        try {
            $this->incident->create($input);
            DB::commit();
            return response()->json(["message" => "Incident Registado com sucesos"], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        }
        
    }
    
    
}
