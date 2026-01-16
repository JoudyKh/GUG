<?php

namespace App\Http\Controllers\Api\Admin\Consultation;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Services\Admin\Consultation\ConsultationService;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function __construct(protected ConsultationService $consultationService)
    {
    }
    /**
     * @OA\Get(
     *     path="/admin/consultations",
     *     tags={"Admin" , "Admin - Consultation"},
     *     summary="get all consultations",
     *    @OA\Parameter(
     *         name="trash",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             enum={0, 1},
     *             example=1
     *         )
     *     ),
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function index(Request $request)
    {
        return success($this->consultationService->index($request));
    }
    /** 
     * @OA\Get(
     *     path="/admin/consultations/{consultation}",
     *     tags={"Admin" , "Admin - Consultation"},
     *     summary="show an consultation",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *      @OA\Parameter(
     *         name="consultation",
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
    public function show(Consultation $consultation)
    {
        try {
            return success($this->consultationService->show($consultation));
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
            /**
     * @OA\Delete(
     *     path="/admin/consultations/{id}",
     *     tags={"Admin" , "Admin - Consultation"},
     *     summary="SoftDelete an existing Consultation",
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
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     * @OA\Delete(
     *     path="/admin/consultations/{id}/force",
     *     tags={"Admin" , "Admin - Consultation"},
     *     summary="SoftDelete an existing Consultation",
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
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public function destroy($consultation, $force = null)
    {
        try {
            return success($this->consultationService->destroy($consultation, $force));
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
            /**
     * @OA\Get(
     *     path="/admin/consultations/{id}/restore",
     *     tags={"Admin", "Admin - Consultation"},
     *     summary="Restore a soft-deleted Consultation",
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
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public function restore($consultation)
    {
        try {
            return success($this->consultationService->restore($consultation));
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
}
