<?php

namespace App\Http\Controllers\Api\General\AboutUs;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutUsResource;
use App\Models\AboutUs;
use App\Services\General\AboutUs\AboutUsService;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function __construct(protected AboutUsService $aboutUsService)
    {
    }
          /**
     * @OA\Get(
     *     path="/about-us",
     *     tags={"App" , "App - AboutUs"},
     *     summary="get all about-us",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AboutUsResource")
     *     )
     * )
     * @OA\Get(
     *     path="/admin/about-us",
     *     tags={"Admin" , "Admin - AboutUs"},
     *     summary="get all about-us",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AboutUsResource")
     *     )
     * )
     */
    public function index()
    {
        try {
            return success($this->aboutUsService->index());
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
    /**
     * @OA\Get(
     *     path="/about-us/{about}",
     *     tags={"App" , "App - AboutUs"},
     *     summary="show an about",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *      @OA\Parameter(
     *         name="about",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AboutUsResource")
     *     )
     * )
     * @OA\Get(
     *     path="/admin/about-us/{about}",
     *     tags={"Admin" , "Admin - AboutUs"},
     *     summary="show an about",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *      @OA\Parameter(
     *         name="about",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AboutUsResource")
     *     )
     * )
     */
    public function show(AboutUs $about)
    {
        return success(AboutUsResource::make($about->load('offices')));
    }
}
