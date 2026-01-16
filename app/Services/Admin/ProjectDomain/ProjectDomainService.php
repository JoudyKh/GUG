<?php

namespace App\Services\Admin\ProjectDomain;
use App\Http\Requests\Api\Admin\ProjectDomain\CreateDomainRequest;
use App\Http\Requests\Api\Admin\ProjectDomain\UpdateDomainRequest;
use App\Models\ProjectDomain;

class ProjectDomainService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(CreateDomainRequest $request)
    {
        $data = $request->validated();
        return ProjectDomain::create($data);
    }
    public function update(UpdateDomainRequest $request, ProjectDomain $domain)
    {
        $data = $request->validated();
        $domain->update($data);
        return $domain;
    }
    public function destroy($domain)
    {
        ProjectDomain::where('id', $domain)->delete();
        return true;
    }
}
