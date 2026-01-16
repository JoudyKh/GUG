<?php

namespace App\Http\Controllers\Api\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Article\CreateArticleRequest;
use App\Http\Requests\Api\Admin\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Services\Admin\Article\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function __construct(protected ArticleService $articleService)
    {
    }
    /**
     * @OA\Post(
     *     path="/admin/articles",
     *     tags={"Admin" , "Admin - Article"},
     *     summary="Create a new Article",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateArticleRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/ArticleResource")
     *     )
     * )
     */
    public function store(CreateArticleRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $this->articleService->store($request);
            DB::commit();
            Cache::flush();
            return success($data, 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }

    /**
     * @OA\Post(
     *     path="/admin/articles/{article}",
     *     tags={"Admin" , "Admin - Article"},
     *     summary="update an existing  Article",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="article",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="_method",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string", enum={"PUT"}, default="PUT")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/UpdateArticleRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/ArticleResource")
     *     )
     * )
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        try {
            return success($this->articleService->update($request, $article));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
    /**
     * @OA\Delete(
     *     path="/admin/articles/{id}",
     *     tags={"Admin" , "Admin - Article"},
     *     summary="SoftDelete an existing Article",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public function destroy($article)
    {
        try {
            return success($this->articleService->destroy($article));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
}
