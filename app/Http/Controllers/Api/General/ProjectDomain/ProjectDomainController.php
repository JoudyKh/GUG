<?php

namespace App\Http\Controllers\Api\General\ProjectDomain;

use App\Http\Controllers\Controller;
use App\Models\ProjectDomain;
use App\Services\General\ProjectDomain\ProjectDomainService;
use Illuminate\Http\Request;

class ProjectDomainController extends Controller
{
    public function __construct(protected ProjectDomainService $projectDomainService)
    {}
      /**
     * @OA\Get(
     *     path="/domains",
     *     tags={"App" , "App - ProjectDomain"},
     *     summary="get all section domains",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     * @OA\Get(
     *     path="/admin/domains",
     *     tags={"Admin" , "Admin - ProjectDomain"},
     *     summary="get all domains",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function index(Request $request)
    {
        try {
            return success($this->projectDomainService->index($request));
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
            /**
     * @OA\Get(
     *     path="/admin/domains/{domain}",
     *     tags={"Admin" , "Admin - ProjectDomain"},
     *     summary="show a ProjectDomain",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *    @OA\Parameter(
     *         name="domain",
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
    public function show(ProjectDomain $domain)
    {
        return success($domain);
    }
}
