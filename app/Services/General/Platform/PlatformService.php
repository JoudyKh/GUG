<?php

namespace App\Services\General\Platform;
use App\Constants\Constants;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlatformService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index(Request $request)
    {
        return Platform::orderByDesc('created_at')->get();        
    }
}
