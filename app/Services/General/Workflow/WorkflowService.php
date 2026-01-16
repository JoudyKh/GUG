<?php

namespace App\Services\General\Workflow;
use App\Constants\Constants;
use App\Models\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkflowService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index(Request $request)
    {
        $workflows = Workflow::orderByDesc('created_at');
        $workflows = $workflows->paginate(config('app.pagination_limit'));
        return $workflows;
    }
}
