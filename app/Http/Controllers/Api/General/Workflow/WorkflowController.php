<?php

namespace App\Http\Controllers\Api\General\Workflow;

use App\Http\Controllers\Controller;
use App\Models\Workflow;
use App\Services\General\Workflow\WorkflowService;
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    public function __construct(protected WorkflowService $workflowService)
    {
    }
    /**
     * @OA\Get(
     *     path="/workflows",
     *     tags={"App" , "App - Workflow"},
     *     summary="get all workflows",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     * @OA\Get(
     *     path="/admin/workflows",
     *     tags={"Admin" , "Admin - Workflow"},
     *     summary="get all workflows",
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
     *     )
     * )
     */
    public function index( Request $request)
    {
        return success($this->workflowService->index($request));

    }
    /**
     * @OA\Get(
     *     path="/workflows/{workflow}",
     *     tags={"App" , "App - Workflow"},
     *     summary="show an workflow",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *      @OA\Parameter(
     *         name="workflow",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     * @OA\Get(
     *     path="/admin/workflows/{workflow}",
     *     tags={"Admin" , "Admin - Workflow"},
     *     summary="show an workflow",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *      @OA\Parameter(
     *         name="workflow",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function show(Workflow $workflow)
    {
        return success($workflow);

    }
}
