<?php

namespace App\Http\Controllers\Api\Admin\AboutUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\AboutUs\CreateAboutUsRequest;
use App\Http\Requests\Api\Admin\AboutUs\UpdateAboutUsRequest;
use App\Models\AboutUs;
use App\Services\Admin\AboutUs\AboutUsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    public function __construct(protected AboutUsService $aboutUsService)
    {
    }
    /**
     * @OA\Post(
     *     path="/admin/about-us",
     *     tags={"Admin" , "Admin - AboutUs"},
     *     summary="Create a new AboutUs",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateAboutUsRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AboutUsResource")
     *     )
     * )
     */
    public function store(CreateAboutUsRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $this->aboutUsService->store($request);
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
     *     path="/admin/about-us/{about}",
     *     tags={"Admin" , "Admin - AboutUs"},
     *     summary="update an existing  AboutUs",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="about",
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
     *             @OA\Schema(ref="#/components/schemas/UpdateAboutUsRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AboutUsResource")
     *     )
     * )
     */
    public function update(UpdateAboutUsRequest $request, AboutUs $about)
    {
        try {
            return success($this->aboutUsService->update($request, $about));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
    /**
     * @OA\Delete(
     *     path="/admin/about-us/{id}",
     *     tags={"Admin" , "Admin - AboutUs"},
     *     summary="SoftDelete an existing AboutUs",
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
    public function destroy($about)
    {
        try {
            return success($this->aboutUsService->destroy($about));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
}
