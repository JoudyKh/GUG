<?php

namespace App\Services\General\Review;
use App\Constants\Constants;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewService
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
        $reviews = Review::orderByDesc( 'created_at');
        return $reviews->get();
        
    }
}
