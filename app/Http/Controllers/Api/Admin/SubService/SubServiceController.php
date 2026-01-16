<?php

namespace App\Http\Controllers\Api\Admin\SubService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\SubService\CreateSubServiceRequest;
use App\Http\Requests\Api\Admin\SubService\UpdateSubServiceRequest;
use App\Models\Section;
use App\Models\SubService;
use App\Services\Admin\SubService\SubServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SubServiceController extends Controller
{
    public function __construct(protected SubServiceService $subServiceService)
    {
    }
    /**
     * @OA\Post(
     *     path="/admin/sections/{section}/sub-services",
     *     tags={"Admin" , "Admin - Section - SubService"},
     *     summary="Create a new Section - SubService",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="section",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateSubServiceRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(Section $section, CreateSubServiceRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $this->subServiceService->store($section, $request);
            DB::commit();
            Cache::flush();
            return success($data, 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }

    /**
     * @OA\Post(
     *     path="/admin/sections/{section}/sub-services/{service}",
     *     tags={"Admin" , "Admin - Section - SubService"},
     *     summary="update an existing  Section - SubService",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="section",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="service",
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
     *             @OA\Schema(ref="#/components/schemas/UpdateSubServiceRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function update(Section $section, UpdateSubServiceRequest $request, SubService $service)
    {
        try {
            return success($this->subServiceService->update($section, $request, $service));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
    /**
     * @OA\Delete(
     *     path="/admin/sections/{section}/sub-services/{id}",
     *     tags={"Admin" , "Admin - Section - SubService"},
     *     summary="SoftDelete an existing Section - SubService",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="section",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
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
    public function destroy(Section $section, $service)
    {
        try {
            return success($this->subServiceService->destroy($section, $service));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
    
}
