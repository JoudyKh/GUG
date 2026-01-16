<?php

namespace App\Http\Controllers\Api\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Slider\CreateSliderRequest;
use App\Http\Requests\Api\Admin\Slider\UpdateSliderRequest;
use App\Services\Admin\Slider\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct(protected SliderService $sliderService)
    {
    }
    /**
     * @OA\Post(
     *     path="/admin/sliders/{type}",
     *     tags={"Admin" , "Admin - Slider"},
     *     summary="Create a new Slider",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         @OA\Schema(enum={"projects", "services"})
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateSliderRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(CreateSliderRequest $request, $type)
    {
        try {
            $data = $this->sliderService->store($request, $type);
            return success($data, 201);

        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }
    /**
     * @OA\Post(
     *     path="/admin/sliders/{type}/update",
     *     tags={"Admin" , "Admin - Slider"},
     *     summary="update an existing Slider",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         @OA\Schema(  
     *             type="string",  
     *             enum={"projects", "services"}  
     *         )  
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
     *             @OA\Schema(ref="#/components/schemas/UpdateSliderRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function update(UpdateSliderRequest $request, $type)
    {
        try {
            $data = $this->sliderService->update($request, $type);
            return success($data);

        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }

    }
}
