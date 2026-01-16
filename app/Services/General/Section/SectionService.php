<?php

namespace App\Services\General\Section;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;

class SectionService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    use SearchTrait;
    public function getAll(Request $request)
    {
        $services = Section::with(['images'])->orderByDesc('created_at');

        $this->applySearchAndSort($services, $request, Section::$searchable);

        $request->paginate === '0' ? $services = $services->get() :
        $services = $services->paginate(config('app.pagination_limit'));
        $services = SectionResource::collection($services);
        return $services;
    }
}
