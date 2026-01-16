<?php

namespace App\Http\Controllers\Api\App\Consultation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\App\Consultation\CreateConsultationRequest;
use App\Services\App\Consultation\ConsultationService;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function __construct(protected ConsultationService $consultationService)
    {
    }
    /**
     * @OA\Post(
     *     path="/consultations",
     *     tags={"App" , "App - Consultation"},
     *     summary="Create a new Consultation",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateConsultationRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(CreateConsultationRequest $request)
    {
        return success($this->consultationService->store($request), 201);
    }
}
