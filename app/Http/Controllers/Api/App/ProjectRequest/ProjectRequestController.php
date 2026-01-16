<?php

namespace App\Http\Controllers\Api\App\ProjectRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\App\ProjectRequest\CreateProjectRequest;
use App\Services\App\ProjectRequest\ProjectRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProjectRequestController extends Controller
{
    public function __construct(protected ProjectRequestService $projectRequestService)
    {}
     /**
     * @OA\Post(
     *     path="/project-requests",
     *     tags={"App" , "App - ProjectRequest"},
     *     summary="Create a new ProjectRequest",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateProjectRequest2") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(CreateProjectRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $this->projectRequestService->store($request);
            DB::commit();
            Cache::flush();
            return success($data, 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }
}
