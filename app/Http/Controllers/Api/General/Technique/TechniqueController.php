<?php

namespace App\Http\Controllers\Api\General\Technique;

use App\Http\Controllers\Controller;
use App\Models\Technique;
use App\Services\General\Technique\TechniqueService;
use Illuminate\Http\Request;

class TechniqueController extends Controller
{
    public function __construct(protected TechniqueService $techniqueService)
    {}
     /**
     * @OA\Get(
     *     path="/techniques",
     *     tags={"App" , "App - Technique"},
     *     summary="get all techniques",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     * @OA\Get(
     *     path="/admin/techniques",
     *     tags={"Admin" , "Admin - Technique"},
     *     summary="get all techniques",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function index()
    {
        try {
            return success($this->techniqueService->index());
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
    /**
     * @OA\Get(
     *     path="/techniques/{id}",
     *     tags={"App" , "App - Technique"},
     *     summary="show one Technique",
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
     *     )
     * )
     * @OA\Get(
     *     path="/admin/techniques/{id}",
     *     tags={"Admin" , "Admin - Technique"},
     *     summary="show one Technique",
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
     *     )
     * )
     */
    public function show(Technique $technique)
    {
        return success($technique);
    }
}
