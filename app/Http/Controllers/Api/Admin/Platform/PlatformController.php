<?php

namespace App\Http\Controllers\Api\Admin\Platform;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Platform\CreatePlatformRequest;
use App\Http\Requests\Api\Admin\Platform\UpdatePlatformRequest;
use App\Models\Platform;
use App\Services\Admin\Platform\PlatformService;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function __construct(protected PlatformService $platformService)
    {}
    
    /**
     * @OA\Post(
     *     path="/admin/platforms",
     *     tags={"Admin" , "Admin - Platform"},
     *     summary="Create a new Platform",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreatePlatformRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(CreatePlatformRequest $request)
    {
        try {
            $data = $this->platformService->store($request);
            return success($data, 201);

        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }

     /**
     * @OA\Post(
     *     path="/admin/platforms/{platform}",
     *     tags={"Admin" , "Admin - Platform"},
     *     summary="update an existing  Platform",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="platform",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
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
     *             @OA\Schema(ref="#/components/schemas/UpdatePlatformRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function update(UpdatePlatformRequest $request, Platform $platform)
    {
        try {
            return success($this->platformService->update( $request, $platform));
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
      /**
     * @OA\Delete(
     *     path="/admin/platforms/{id}",
     *     tags={"Admin" , "Admin - Platform"},
     *     summary="SoftDelete an existing Platform",
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
    public function destroy($platform)
    {
        try {
            return success($this->platformService->destroy($platform));
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
}
