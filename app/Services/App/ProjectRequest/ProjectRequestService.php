<?php

namespace App\Services\App\ProjectRequest;
use App\Http\Requests\Api\App\ProjectRequest\CreateProjectRequest;
use App\Http\Resources\ProjectRequestResource;
use App\Models\ProjectRequest;

class ProjectRequestService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(CreateProjectRequest $request)
    {
        $data = $request->validated();
        $projectRequest = ProjectRequest::create($data);
        if($request->platforms)
            $projectRequest->platforms()->attach($data['platforms']);
        return ProjectRequestResource::make($projectRequest->load(['platforms', 'domain']));
    }
}
