<?php

namespace App\Http\Controllers\Api\General\Section;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Project;
use App\Models\Section;
use App\Models\Slider;
use App\Services\General\Section\SectionService;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct(protected SectionService $sectionService)
    {}
    /** 
     * @OA\Get(
     *      path="/sections",
     *      summary="get services sections data",
     *      tags={"App", "App - Section"},
     *     security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(response=200, description="Successful operation"),
     *  )
     * @OA\Get(
     *      path="/admin/sections",
     *      operationId="admin/super-sections",
     *      summary="get services sections data",
     *      tags={"Admin", "Admin - Section"},
     *     security={{ "bearerAuth": {}, "Accept": "json/application" }},
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
     *     @OA\Parameter(
     *         name="paginate",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             enum={0},
     *         )
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *  )
     */

     public function index(Request $request)
    {
        $sliders = Slider::where('type', 'services')
            ->get();
        $projects = Project::orderByDesc('created_at')->take(10)->get();

        return success($this->sectionService->getAll($request), 200, ['projects' => $projects, 'sliders' => $sliders]);
    }
    /**
     * @OA\Get(
     *      path="/sections/{section_id}",
     *      operationId="app/section",
     *      summary="get section data ",
     *      tags={"App", "App - Section"},
     *       @OA\Parameter(
     *      name="section_id",
     *      in="path",
     *      description="pass the section ",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *       ),
     *     security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(response=200, description="Successful operation"),
     *  )
     *
     * @OA\Get(
     *     path="/admin/sections/{section_id}",
     *     operationId="admin/section",
     *     summary="get section data ",
     *     tags={"Admin", "Admin - Section"},
     *      @OA\Parameter(
     *     name="section_id",
     *     in="path",
     *     description="pass the section ",
     *     required=true,
     *     @OA\Schema(
     *         type="integer"
     *     )
     *      ),
     *    security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *    @OA\Response(response=200, description="Successful operation"),
     * )
     */
    public function show(Section $section)
    {
        $services = Section::with('images')->take(3)->get();
        return success(SectionResource::make($section->load(['images', 'subServices', 'projects'])), 200, ['services' => $services]);
    }

}
