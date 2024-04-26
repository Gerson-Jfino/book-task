<?php

namespace App\Http\Controllers\Incident;

use App\Models\Incident;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    private $incident;
    public function __construct(Incident $incident) {
        $this->incident = $incident;
    }
    public function index() {
        $incidents = $this->incident->get();
        return response()->json($incidents, 200);
    }
    
    
}
