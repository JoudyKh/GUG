<?php

namespace App\Services\Admin\Platform;
use App\Http\Requests\Api\Admin\Platform\CreatePlatformRequest;
use App\Http\Requests\Api\Admin\Platform\UpdatePlatformRequest;
use App\Models\Platform;

class PlatformService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(CreatePlatformRequest $request)
    {
        $data = $request->validated();
        return Platform::create($data);
    }
    public function update(UpdatePlatformRequest $request, Platform $platform)
    {
        $data = $request->validated();
        $platform->update($data);
        return $platform;
    }
    public function destroy($platform)
    {
        $platform =  Platform::findOrFail($platform);
        $platform->deleteOrFail();
        return true;
    }
}
