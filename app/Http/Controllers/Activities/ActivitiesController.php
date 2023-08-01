<?php

namespace App\Http\Controllers\Activities;

use App\Models\Activitie;
use App\Models\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivitiesController extends Controller
{
    private $activitie;
    private $status;
    public function __construct(Activitie $activitie, Status $status) {
        $this->activitie = $activitie;
        $this->status = $status;
    }
    public function show($id) {
        $activitie = $this->activitie->with('status')->find($id);
        return response()->json($activitie, 200);
    }
    public function index(){
        $activities = $this->activitie->with('status')->get()->map(function ($act) {
            return [
                "id" => $act->id,
                "name" => $act->name,
                "manager" => $act->manager,
                "owner" => $act->owner,
                "start_date" => $act->start_date,
                "due_date" => $act->due_date,
                "final_date" => $act->final_date,
                "status" => $act->status->name
            ];
        });
        return response()->json($activities, 200);
    }
    public function indexStatus() {
        $status = $this->status->get();
        return response()->json($status, 200);
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'manager' => 'required|string',
            'status_id' => 'required|integer|exists:status,id',
            'owner' => 'required|string',
            'start_date' => 'required',
            'due_date' => 'nullable',
            'final_date' => 'required',
            'status_situation' => 'nullable'
        ]);

        $input = $request->only(
            [
                'name',
                'manager',
                'status_id',
                'owner',
                'start_date',
                'due_date',
                'final_date',
                'status_situation'
            ]
        );
        $input['start_date'] = date('Y-m-d', strtotime($request['start_date']));
        $input['due_date'] = date('Y-m-d',strtotime($request['due_date']));
        $input['final_date'] = date('Y-m-d',strtotime($request['final_date']));
        DB::beginTransaction();
        try {
            $activitie = $this->activitie->create($input);
            DB::commit();
            return response()->json($activitie, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        }
    }
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'nullable|string',
            'manager' => 'nullable|string',
            'status_id' => 'nullable|integer|exists:status,id',
            'owner' => 'nullable|string',
            'start_date' => 'nullable',
            'due_date' => 'nullable',
            'final_date' => 'required',
            'status_situation' => 'nullable'
        ]);
        $input = $request->only(
            [
                'name',
                'manager',
                'status_id',
                'owner',
                'start_date',
                'due_date',
                'final_date',
                'status_situation'
            ]
        );
        $activitie = $this->activitie->find($id);
        if (empty($activitie)) {
            return response()->json(["message" => "Atividade não encontrada"], 404);
        }
        DB::beginTransaction();
        try {
            $activitie->update($input);
            DB::commit();
            return response()->json($activitie, 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        }
    }
    public function remove($id) {
        $activitie = $this->activitie->find($id);
        if (empty($activitie)) {
            return response()->json(["message" => 'Atividade não encontrada'], 404);
        }
        DB::beginTransaction();
        try {
            $activitie->delete();
            DB::commit();
            return response()->json(["message" => "Atividade apagada com sucesso"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        }
    }
}
