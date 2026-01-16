<?php

namespace App\Http\Controllers\Api\General\Project;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Section;
use App\Models\Slider;
use App\Services\General\Project\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService)
    {
    }
    /**
     * @OA\Get(
     *     path="/sections/{section}/projects",
     *     tags={"App" , "App - Section - Project"},
     *     summary="get all sections/{section}/projects",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *    @OA\Parameter(
     *         name="section",
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
     *     path="/admin/sections/{section}/projects",
     *     tags={"Admin" , "Admin - Section - Project"},
     *     summary="get all sections/{section}/projects",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *    @OA\Parameter(
     *         name="section",
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
     *     path="/sections/all/projects",
     *     tags={"App" , "App - Section - Project"},
     *     summary="get all sections/{section}/projects",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     * @OA\Get(
     *     path="/admin/sections/all/projects",
     *     tags={"Admin" , "Admin - Section - Project"},
     *     summary="get all sections/{section}/projects",
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
    public function index($section, Request $request)
    {
        $sliders = Slider::where('type', 'projects')
        ->get();
        return success($this->projectService->index($section, $request), 200, ['sliders' => $sliders]);

    }
    /**
     * @OA\Get(
     *     path="/sections/{section}/projects/{project}",
     *     tags={"App" , "App - Section - Project"},
     *     summary="show an project",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *    @OA\Parameter(
     *         name="section",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\Parameter(
     *         name="project",
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
     *     path="/admin/sections/{section}/projects/{project}",
     *     tags={"Admin" , "Admin - Section - Project"},
     *     summary="show an project",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *    @OA\Parameter(
     *         name="section",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\Parameter(
     *         name="project",
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
    public function show(Section $section, Project $project)
    {
        return success (ProjectResource::make($project->load('images')));

    }
}
