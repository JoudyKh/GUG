<?php

namespace App\Services\General\AboutUs;
use App\Http\Resources\AboutUsResource;
use App\Models\AboutUs;

class AboutUsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index()
    {
        $all_about = AboutUs::with('offices')->orderByDesc('created_at')->get();
        return AboutUsResource::collection($all_about);
    }
}
