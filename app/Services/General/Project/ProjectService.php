<?php

namespace App\Services\General\Project;
use App\Constants\Constants;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index($section, Request $request)
    {
        if($section !== 'all'){
            $section = Section::find($section);
            $projects = $section->projects();
        }
        else{
            $projects = Project::query();
        }
        $projects = $projects->with('images')->orderByDesc('created_at')->paginate(config('app.pagination_limit'));
        return ProjectResource::collection($projects);
    }
}
