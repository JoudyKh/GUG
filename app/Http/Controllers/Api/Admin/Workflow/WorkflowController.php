<?php

namespace App\Http\Controllers\Api\Admin\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Workflow\CreateWorkflowRequest;
use App\Http\Requests\Api\Admin\Workflow\UpdateWorkflowRequest;
use App\Models\Workflow;
use App\Services\Admin\Workflow\WorkflowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WorkflowController extends Controller
{
    public function __construct(protected WorkflowService $workflowService)
    {
    }
    /**
     * @OA\Post(
     *     path="/admin/workflows",
     *     tags={"Admin" , "Admin - Workflow"},
     *     summary="Create a new Workflow",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateWorkflowRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(CreateWorkflowRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $this->workflowService->store($request);
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
     *     path="/admin/workflows/{workflow}",
     *     tags={"Admin" , "Admin - Workflow"},
     *     summary="update an existing  Workflow",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="workflow",
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
     *             @OA\Schema(ref="#/components/schemas/UpdateWorkflowRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function update(UpdateWorkflowRequest $request, Workflow $workflow)
    {
        try {
            return success($this->workflowService->update($request, $workflow));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
    /**
     * @OA\Delete(
     *     path="/admin/workflows/{id}",
     *     tags={"Admin" , "Admin - Workflow"},
     *     summary="SoftDelete an existing Workflow",
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
    public function destroy($workflow)
    {
        try {
            return success($this->workflowService->destroy($workflow));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
}
