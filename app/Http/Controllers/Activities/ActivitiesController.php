<?php

namespace App\Http\Controllers\Activities;

use App\Models\Activitie;
use App\Models\Status;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ActivitiesController extends Controller
{
    private $activitie;
    private $status;
    private $user;
    public function __construct(Activitie $activitie, Status $status, User $user) {
        $this->activitie = $activitie;
        $this->status = $status;
        $this->user = $user;
    }
    public function show($id) {
        $activitie = $this->activitie->with(['user', 'status'])->find($id);
        return response()->json($activitie, 200);
    }
    public function index(){
        $filter = request('s_name');
        $status = request('s_status');
        $user = Auth::user();
        if (!empty($filter)){
            $activities = $this->activitie->with(['user', 'status'])->whereHas('user', function($q) use ($filter) {
                $q->where('name', 'like', "%$filter%");
            })->get()->map(function ($act) {
                return [
                    "id" => $act->id,
                    "name" => $act->name,
                    "manager" => $act->manager,
                    "owner" => $act->owner,
                    "start_date" => $act->start_date,
                    "due_date" => $act->due_date,
                    "final_date" => $act->final_date,
                    "status" => $act->status->name,
                    "user" => $act->user->name,
                    "user_id" => $act->user_id
                ];
            });
        } elseif (!empty($status)){
            $activities = $this->activitie->with(['user', 'status'])->whereHas('status', function($q) use ($status) {
                $q->where('id', '=', $status);
            })->get()->map(function ($act) {
                return [
                    "id" => $act->id,
                    "name" => $act->name,
                    "manager" => $act->manager,
                    "owner" => $act->owner,
                    "start_date" => $act->start_date,
                    "due_date" => $act->due_date,
                    "final_date" => $act->final_date,
                    "status" => $act->status->name,
                    "user" => $act->user->name,
                    "user_id" => $act->user_id
                ];
            });
        } else {
            $activities = $this->activitie->with(['user', 'status'])->get()->map(function ($act) {
                return [
                    "id" => $act->id,
                    "name" => $act->name,
                    "manager" => $act->manager,
                    "owner" => $act->owner,
                    "start_date" => $act->start_date,
                    "due_date" => $act->due_date,
                    "final_date" => $act->final_date,
                    "status" => $act->status->name,
                    "user" => $act->user->name,
                    "user_id" => $act->user_id
                ];
            });
        }
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
            'status_situation' => 'nullable',
            'document' => 'nullable|file'
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
        $input['user_id'] = Auth::user()->id;
        $input['start_date'] = date('Y-m-d', strtotime($request['start_date']));
        $input['due_date'] = date('Y-m-d',strtotime($request['due_date']));
        $input['final_date'] = date('Y-m-d',strtotime($request['final_date']));
        DB::beginTransaction();
        try {
            if ($request->document) {
                $path = 'uploads';
                $document = time().'.' . $request->document->getClientOriginalExtension();
                $request->document->move(public_path($path), $document);
                $input['document'] = $path . '/' . $document;
            }
            $activitie = $this->activitie->create($input);
            DB::commit();
            return response()->json($input, 201);
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
            'status_situation' => 'nullable',
            'document' => 'nullable|file',
            'observation' => 'nullable'
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
                'status_situation',
                'observation'
            ]
        );
        $activitie = $this->activitie->find($id);
        if (empty($activitie)) {
            return response()->json(["message" => "Atividade não encontrada"], 404);
        }
        DB::beginTransaction();
        try {
            if ($request->document) {
                $path = 'uploads';
                $document = time().'.' . $request->document->getClientOriginalExtension();
                $request->document->move(public_path($path), $document);
                $input['document'] = $path . '/' . $document;
            }
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
    public function dashboardData() {
        $totalUsers = $this->user->get()->count();
        $totalActivities = $this->activitie->get()->count();
        $admin = $this->user->where('role_id', 1)->get()->count();
        $normal = $this->user->where('role_id', 2)->get()->count();
        $emCurso = $this->activitie->where('status_id', 1)->get()->count(); 
        $supervisor = $this->activitie->where('status_id', 2)->get()->count(); 
        $continuo = $this->activitie->where('status_id', 3)->get()->count(); 
        $pendente = $this->activitie->where('status_id', 4)->get()->count(); 
        $concluido = $this->activitie->where('status_id', 5)->get()->count(); 
        return response()->json([
            'usersTotla' => $totalUsers,
            'users' => [
                'admin' => $admin,
                'normal' => $normal
            ],
            'actividadestotal' =>$totalActivities,
            'status' => [
                'curso'=> $emCurso,
                'continuo' => $supervisor,
                'supervisor' => $supervisor,
                'pendente' => $pendente,
                'concluido' => $concluido
            ]
        ], 200);
    }
}
