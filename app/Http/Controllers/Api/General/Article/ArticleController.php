<?php

namespace App\Http\Controllers\Api\General\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\General\Article\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(protected ArticleService $articleService)
    {
    }
          /**
     * @OA\Get(
     *     path="/articles",
     *     tags={"App" , "App - Article"},
     *     summary="get all articles",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/ArticleResource")
     *     )
     * )
     * @OA\Get(
     *     path="/admin/articles",
     *     tags={"Admin" , "Admin - Article"},
     *     summary="get all articles",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},  
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/ArticleResource")
     *     )
     * )
     */
    public function index(Request $request)
    {
        try {
            return success($this->articleService->index($request));
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
    /**
     * @OA\Get(
     *     path="/articles/{article}",
     *     tags={"App" , "App - Article"},
     *     summary="show an article",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *      @OA\Parameter(
     *         name="article",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/ArticleResource")
     *     )
     * )
     * @OA\Get(
     *     path="/admin/articles/{article}",
     *     tags={"Admin" , "Admin - Article"},
     *     summary="show an article",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *      @OA\Parameter(
     *         name="article",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/ArticleResource")
     *     )
     * )
     */
    public function show(Article $article)
    {
        try {
            return success($this->articleService->show($article));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
}
