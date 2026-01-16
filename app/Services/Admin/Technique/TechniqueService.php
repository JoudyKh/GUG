<?php

namespace App\Services\Admin\Technique;
use App\Http\Requests\Api\Admin\Technique\CreateTechniqueRequest;
use App\Http\Requests\Api\Admin\Technique\UpdateTechniqueRequest;
use App\Models\Technique;
use Illuminate\Support\Facades\Storage;

class TechniqueService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(CreateTechniqueRequest $request)
    {
        $data = $request->validated();
        if (!$request->hasFile('logo'))
            throw new \Exception(__('messages.file_not_sent'), 422);
        $data['logo'] = $data['logo']->storePublicly('techniques/logo', 'public');
        $technique = Technique::create($data);
        return $technique;
    }
    public function update(UpdateTechniqueRequest $request, Technique $technique)
    {
        $data = $request->validated();
        if (!$request->hasFile('logo'))
            throw new \Exception(__('messages.file_not_sent'), 422);
        if (Storage::exists("public/$technique->logo")) {
            Storage::delete("public/$technique->logo");
        }
        $data['logo'] = $data['logo']->storePublicly('techniques/logo', 'public');
        $technique->update($data);
        return $technique;
    }
    public function destroy($technique)
    {
        $technique = Technique::findOrFail($technique);
        if (Storage::exists("public/$technique->logo")) {
            Storage::delete("public/$technique->logo");
        }

        $technique->delete();

        return true;
    }
}
