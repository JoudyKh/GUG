<?php

namespace App\Services\Admin\Workflow;
use App\Http\Requests\Api\Admin\Workflow\CreateWorkflowRequest;
use App\Http\Requests\Api\Admin\Workflow\UpdateWorkflowRequest;
use App\Models\Workflow;
use Illuminate\Support\Facades\Storage;

class WorkflowService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(CreateWorkflowRequest $request)
    {
        $data = $request->validated();
        $data['logo'] = $data['logo']->storePublicly('workflows/logo', 'public');
        return Workflow::create($data);
    }

    public function update(UpdateWorkflowRequest $request, Workflow $workflow)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            if (Storage::exists("public/$workflow->logo")) {
                Storage::delete("public/$workflow->logo");
            }
            $data['logo'] = $data['logo']->storePublicly('workflows/logo', 'public');
        }
        $workflow->update($data);
        return $workflow;
    }
    public function destroy($workflow)
    {
        $workflow = Workflow::where('id', $workflow)->first();
        if (Storage::exists("public/$workflow->logo")) {
            Storage::delete("public/$workflow->logo");
        }
        $workflow->delete();
        return true;
    }
}
