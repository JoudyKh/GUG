<?php

namespace App\Http\Controllers\Api\Admin\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Review\CreateReviewRequest;
use App\Http\Requests\Api\Admin\Review\UpdateReviewRequest;
use App\Models\Review;
use App\Services\Admin\Review\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function __construct(protected ReviewService $reviewService)
    {}
     /**
     * @OA\Post(
     *     path="/admin/reviews",
     *     tags={"Admin" , "Admin - Review"},
     *     summary="Create a new Review",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateReviewRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(CreateReviewRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $this->reviewService->store($request);
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
     *     path="/admin/reviews/{review}",
     *     tags={"Admin" , "Admin - Review"},
     *     summary="update an existing  Review",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="review",
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
     *             @OA\Schema(ref="#/components/schemas/UpdateReviewRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        DB::beginTransaction();

        try {
            $data = $this->reviewService->update($request, $review);
            DB::commit();
            Cache::flush();
            return success($data, 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }
       /**
     * @OA\Delete(
     *     path="/admin/reviews/{id}",
     *     tags={"Admin" , "Admin - Review"},
     *     summary="SoftDelete an existing Review",
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
    public function destroy(Review $review)
    {
        return success($this->reviewService->destroy($review));
    }
}
