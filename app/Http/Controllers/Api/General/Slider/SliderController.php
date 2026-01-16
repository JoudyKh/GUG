<?php

namespace App\Http\Controllers\Api\General\Slider;

use App\Http\Controllers\Controller;
use App\Services\General\Slider\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct(protected SliderService $sliderService)
    {
    }
    /**
     * @OA\Get(
     *     path="/sliders/{type}",
     *     tags={"App" , "App - Slider"},
     *     summary="get all sliders",
     *    @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         @OA\Schema(enum={"projects", "services"})
     *     ),
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     * @OA\Get(
     *     path="/admin/sliders/{type}",
     *     tags={"Admin" , "Admin - Slider"},
     *     summary="get all sliders",
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         @OA\Schema(enum={"projects", "services"})
     *     ),
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function index($type)
    {
        try {
            return success($this->sliderService->index($type));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
}
