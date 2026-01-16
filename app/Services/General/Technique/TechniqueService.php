<?php

namespace App\Services\General\Technique;
use App\Models\Technique;

class TechniqueService
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
        return Technique::orderByDesc('created_at')->get();
    }
}
