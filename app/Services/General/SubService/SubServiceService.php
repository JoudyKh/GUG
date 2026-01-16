<?php

namespace App\Services\General\SubService;
use App\Constants\Constants;
use App\Models\Section;
use App\Models\SubService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubServiceService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index( $section, Request $request)
    {
        if($section !== 'all'){
            $section = Section::findOrFail($section);
            $sub_services = $section->subServices()->orderByDesc('created_at');
        }else{
            $sub_services = SubService::query();
        }
        $sub_services = $sub_services->paginate(config('app.pagination_limit'));
        return $sub_services;
    }
}
