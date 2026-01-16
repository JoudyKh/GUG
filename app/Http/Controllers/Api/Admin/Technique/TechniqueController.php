<?php

namespace App\Http\Controllers\Api\Admin\Technique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Technique\CreateTechniqueRequest;
use App\Http\Requests\Api\Admin\Technique\UpdateTechniqueRequest;
use App\Models\Technique;
use App\Services\Admin\Technique\TechniqueService;
use Illuminate\Http\Request;

class TechniqueController extends Controller
{
    public function __construct(protected TechniqueService $techniqueService)
    {}
    /**
     * @OA\Post(
     *     path="/admin/techniques",
     *     tags={"Admin" , "Admin - Technique"},
     *     summary="Create a new Technique",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateTechniqueRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(CreateTechniqueRequest $request)
    {
        try {
            $data = $this->techniqueService->store($request);
            return success($data, 201);

        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }
     /**
     * @OA\Post(
     *     path="/admin/techniques/{id}",
     *     tags={"Admin" , "Admin - Technique"},
     *     summary="update an existing Technique",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="id",
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
     *             @OA\Schema(ref="#/components/schemas/UpdateTechniqueRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function update(UpdateTechniqueRequest $request, Technique $technique)
    {
        try {
            $data = $this->techniqueService->update($request, $technique);
            return success($data);

        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }

    }
      /**
     * @OA\Delete(
     *     path="/admin/techniques/{id}",
     *     tags={"Admin" , "Admin - Technique"},
     *     summary="SoftDelete an existing Technique",
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
    public function destroy($technique)
    {
        try {
            $data = $this->techniqueService->destroy($technique);
            return success($data);

        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }
}
