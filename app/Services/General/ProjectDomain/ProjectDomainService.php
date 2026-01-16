<?php

namespace App\Services\General\ProjectDomain;
use App\Constants\Constants;
use App\Models\ProjectDomain;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnSelf;

class ProjectDomainService
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
        $domains = ProjectDomain::orderByDesc('created_at');
        return $domains->get();
        
    }
}
