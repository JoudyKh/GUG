<?php

namespace App\Services\App\Home;
use App\Models\Article;
use App\Models\Client;
use App\Models\Project;
use App\Models\Review;
use App\Models\Section;
use App\Models\Technique;
use App\Models\Workflow;

class HomeService
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
        $data = [];
        $data['services'] = Section::with([
            'images',
            'projects' => function ($query) {
                $query->orderByDesc('created_at')->take(10);
            }
        ])->orderByDesc('created_at')->take(10)->get();
        $data['projects'] = Project::orderByDesc('created_at')->take(10)->get();
        $data['clients'] = Client::orderByDesc('created_at')->take(10)->get();
        $data['reviews'] = Review::orderByDesc('created_at')->take(10)->get();
        $data['workflows'] = Workflow::orderByDesc('created_at')->take(10)->get();
        $data['techniques'] = Technique::orderByDesc('created_at')->take(10)->get();
        $data['articles'] = Article::orderByDesc('created_at')->take(10)->get();
        return $data;
    }
}
