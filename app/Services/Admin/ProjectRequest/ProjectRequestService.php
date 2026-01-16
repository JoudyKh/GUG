<?php

namespace App\Services\Admin\ProjectRequest;
use App\Constants\Constants;
use App\Http\Resources\ProjectRequestResource;
use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectRequestService
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
        $projectRequests = ProjectRequest::with(['platforms', 'domain'])->orderByDesc($request->trash ? 'deleted_at' : 'created_at');
        if ($request->has('trash') && $request->input('trash') == 1 && Auth::user()?->hasRole(Constants::ADMIN_ROLE)) {
            $projectRequests->onlyTrashed();
        }
        $projectRequests = $projectRequests->paginate(config('app.pagination_limit'));
        return ProjectRequestResource::collection($projectRequests);
    }
    public function show(ProjectRequest $projectRequest)
    {
        return ProjectRequestResource::make($projectRequest->load(['platforms', 'domain']));
    }
    public function destroy($request, $force = null)
    {
        if ($force) {
            $request = ProjectRequest::onlyTrashed()->findOrFail($request);
            $request->forceDelete();
        } else {
            $request = ProjectRequest::where('id', $request)->first();
            $request->delete();
        }
        return true;
    }
    public function restore($request)
    {
        $request = ProjectRequest::withTrashed()->find($request);
        if ($request && $request->trashed()) {
            $request->restore();
            return true;
        }
        throw new \Exception(__('messages.not_found'), 404);
    }
}
