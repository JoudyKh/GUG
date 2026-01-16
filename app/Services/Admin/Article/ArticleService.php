<?php

namespace App\Services\Admin\Article;
use App\Http\Requests\Api\Admin\Article\CreateArticleRequest;
use App\Http\Requests\Api\Admin\Article\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function store(CreateArticleRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $data['image']->storePublicly('articles/images', 'public');
        $article = Article::create($data);
        return ArticleResource::make($article);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if (Storage::exists("public/$article->image")) {
                Storage::delete("public/$article->image");
            }
            $data['image'] = $data['image']->storePublicly('articles/images', 'public');
        }
        $article->update($data);
        $article = Article::find($article->id);
        return ArticleResource::make($article);
    }
    public function destroy($article)
    {
        $article = Article::where('id', $article)->first();
        if (Storage::exists("public/$article->image")) {
            Storage::delete("public/$article->image");
        }
        $article->delete();
        return true;
    }

}
