<?php

namespace App\Http\Controllers\Api\Admin\Section;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Section\StoreSectionRequest;
use App\Http\Requests\Api\Admin\Section\UpdateSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use App\Services\Admin\Section\SectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function __construct(protected SectionService $sectionService)
    {
    }

    /**
     * @OA\Post(
     *       path="/admin/sections",
     *       operationId="post-super-section",
     *      tags={"Admin", "Admin - Section"},
     *       security={{ "bearerAuth": {} }},
     *       summary="Store Super Section data",
     *       description="Store Super Section with the provided information",
     *       @OA\RequestBody(
     *           required=true,
     *           description="Section data",
     *               @OA\MediaType(
     *               mediaType="multipart/form-data",
     *               @OA\Schema(
     *               required={"title", "description", "logo"},
     *               @OA\Property(property="title", type="string", example="Arabic section name "),
     *               @OA\Property(property="description", type="string", example="English section name "),
     *               @OA\Property(
     *                      property="logo",
     *                      type="string",
     *                      format="binary",
     *                      description="Image file to upload"
     *                  ),
     *               @OA\Property(
     *                      property="images[0]",
     *                      type="string",
     *                      format="binary",
     *                      description="Image file to upload"
     *                  ),
     *           ),
     *    ),
     *       ),
     *       @OA\Response(
     *           response=201,
     *           description="Section stored successfully",
     *           @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="Section stored successfully"),
     *           )
     *       ),
     *       @OA\Response(
     *           response=422,
     *           description="Validation error",
     *           @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="The given data was invalid."),
     *           )
     *       ),
     *  )
     */
    public function store(StoreSectionRequest $request)
    {
        try {
            return success($this->sectionService->store($request), 201);
        } catch (\Throwable $th) {
            return $th;
            return error($th->getMessage(), [$th->getMessage()], 400);
        }
    }
    /**
     * @OA\Post(
     *      path="/admin/sections/{id}",
     *      operationId="store-section",
     *     tags={"Admin", "Admin - Section"},
     *     @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="section id to update ",
     *        required=false,
     *        @OA\Schema(
     *            type="integer"
     *        )
     *      ),
     *     @OA\Parameter(
     *         name="_method",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string", enum={"PUT"}, default="PUT")
     *     ),
     *      security={{ "bearerAuth": {} }},
     *      summary="Update Section data",
     *      description="Update Section with the provided information",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Section data",
     *              @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              @OA\Property(property="title", type="string", example="Arabic section name "),
     *              @OA\Property(property="description", type="string", example="English section name "),
     *              @OA\Property(
     *                     property="logo",
     *                     type="string",
     *                     format="binary",
     *                     description="Image file to upload"
     *                 ),
     *              @OA\Property(
     *                     property="images[0]",
     *                     type="string",
     *                     format="binary",
     *                     description="Image file to upload"
     *                 ),
     *              @OA\Property(
     *                     property="delete_images[0]",
     *                     type="integer",
     *                 ),
     *          ),
     *   ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Section updated successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Section udpated successfully"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *          )
     *      ),
     * )
     */

    public function update(UpdateSectionRequest $request, Section $section)
    {
        try {
            return success($this->sectionService->update($request, $section));
        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], 400);
        }

    }

    /**
     *  @OA\Delete(
     *     path="/admin/sections/{id}",
     *     tags={"Admin", "Admin - Section"},
     *     summary="Delete an section or brand",
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the section or brand to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     security={{ "bearerAuth": {} }},
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
    public function delete($id)
    {
        try {
            return success($this->sectionService->delete($id));
        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], 400);
        }
    }
}
