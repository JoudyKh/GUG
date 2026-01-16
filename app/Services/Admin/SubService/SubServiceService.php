<?php

namespace App\Services\Admin\SubService;
use App\Http\Requests\Api\Admin\SubService\CreateSubServiceRequest;
use App\Http\Requests\Api\Admin\SubService\UpdateSubServiceRequest;
use App\Models\Section;
use App\Models\SubService;
use Illuminate\Support\Facades\Storage;

class SubServiceService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(Section $section, CreateSubServiceRequest $request)
    {
        $data = $request->validated();
        $data['logo'] = $data['logo']->storePublicly('sub_services/logo', 'public');
        $data['section_id'] = $section->id;
        return SubService::create($data);
    }

    public function update(Section $section, UpdateSubServiceRequest $request, SubService $sub_service)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            if (Storage::exists("public/$sub_service->logo")) {
                Storage::delete("public/$sub_service->logo");
            }
            $data['logo'] = $data['logo']->storePublicly('sub_services/logo', 'public');
        }
        $sub_service->update($data);
        return $sub_service;
    }
    public function destroy(Section $section, $sub_service)
    {
        $sub_service = SubService::where('id', $sub_service)->first();
        if (Storage::exists("public/$sub_service->logo")) {
            Storage::delete("public/$sub_service->logo");
        }
        $sub_service->delete();
        return true;
    }

}
