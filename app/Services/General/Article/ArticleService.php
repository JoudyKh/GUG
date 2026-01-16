<?php

namespace App\Services\General\Article;
use App\Constants\Constants;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleService
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
        $articles = Article::orderByDesc( 'created_at');
        $articles = $articles->paginate(config('app.pagination_limit'));
        return ArticleResource::collection($articles);
    }
    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }
}
