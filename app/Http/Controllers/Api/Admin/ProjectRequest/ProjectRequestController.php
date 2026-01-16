<?php

namespace App\Http\Controllers\Api\Admin\ProjectRequest;

use App\Http\Controllers\Controller;
use App\Models\ProjectRequest;
use App\Services\Admin\ProjectRequest\ProjectRequestService;
use Illuminate\Http\Request;

class ProjectRequestController extends Controller
{
    public function __construct(protected ProjectRequestService $projectRequestService)
    {
    }
    /**
     * @OA\Get(
     *     path="/admin/project-requests",
     *     tags={"Admin" , "Admin - ProjectRequest"},
     *     summary="get all project-requests",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="trash",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             enum={0, 1},
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/ProjectRequestResource")
     *     )
     * )
     */
    public function index(Request $request)
    {
        return success($this->projectRequestService->index($request));
    }
    /** 
     * @OA\Get(
     *     path="/admin/project-requests/{request}",
     *     tags={"Admin" , "Admin - ProjectRequest"},
     *     summary="show an request",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *      @OA\Parameter(
     *         name="request",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/ProjectRequestResource")
     *     )
     * )
     */
    public function show(ProjectRequest $request)
    {
        try {
            return success($this->projectRequestService->show($request));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
          /**
     * @OA\Delete(
     *     path="/admin/project-requests/{id}",
     *     tags={"Admin" , "Admin - ProjectRequest"},
     *     summary="SoftDelete an existing ProjectRequest",
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
     * @OA\Delete(
     *     path="/admin/project-requests/{id}/force",
     *     tags={"Admin" , "Admin - ProjectRequest"},
     *     summary="SoftDelete an existing ProjectRequest",
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
    public function destroy($request, $force = null)
    {
        try {
            return success($this->projectRequestService->destroy($request, $force));
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
            /**
     * @OA\Get(
     *     path="/admin/project-requests/{id}/restore",
     *     tags={"Admin", "Admin - ProjectRequest"},
     *     summary="Restore a soft-deleted ProjectRequest",
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
    public function restore($request)
    {
        try {
            return success($this->projectRequestService->restore($request));
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
}
