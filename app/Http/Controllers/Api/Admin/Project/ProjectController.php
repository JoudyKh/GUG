<?php

namespace App\Http\Controllers\Api\Admin\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Project\CreateProjectRequest;
use App\Http\Requests\Api\Admin\Project\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Section;
use App\Services\Admin\Project\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService)
    {
    }
    /**
     * @OA\Post(
     *     path="/admin/sections/{section}/projects",
     *     tags={"Admin" , "Admin - Section - Project"},
     *     summary="Create a new Section - Project",
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
     *             @OA\Schema(ref="#/components/schemas/CreateProjectRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(Section $section, CreateProjectRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $this->projectService->store($section, $request);
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
     *     path="/admin/sections/{section}/projects/{project}",
     *     tags={"Admin" , "Admin - Section - Project"},
     *     summary="update an existing  Section - Project",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="section",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="project",
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
     *             @OA\Schema(ref="#/components/schemas/UpdateProjectRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function update(Section $section, UpdateProjectRequest $request, Project $project)
    {
        try {
            return success($this->projectService->update($section, $request, $project));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
    /**
     * @OA\Delete(
     *     path="/admin/sections/{section}/projects/{id}",
     *     tags={"Admin" , "Admin - Section - Project"},
     *     summary="SoftDelete an existing Section - Project",
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
    public function destroy(Section $section, $project)
    {
        try {
            return success($this->projectService->destroy($section, $project));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
}
