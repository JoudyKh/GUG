<?php

namespace App\Http\Controllers\Api\General\Platform;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Services\General\Platform\PlatformService;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function __construct(protected PlatformService $platformService)
    {}
    /**
   * @OA\Get(
   *     path="/platforms",
   *     tags={"App" , "App - Platform"},
   *     summary="get all section platforms",
   *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
   *     @OA\Response(
   *         response=200,
   *         description="Successful operation",
   *     )
   * )
   * @OA\Get(
   *     path="/admin/platforms",
   *     tags={"Admin" , "Admin - Platform"},
   *     summary="get all platforms",
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
          return success($this->platformService->index($request));
      }  catch (\Exception $e) {
          return error($e->getMessage(), [$e->getMessage()], $e->getCode());
      }
  }
          /**
   * @OA\Get(
   *     path="/admin/platforms/{platform}",
   *     tags={"Admin" , "Admin - Platform"},
   *     summary="show a Platform",
   *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
   *    @OA\Parameter(
   *         name="platform",
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
  public function show(Platform $platform)
  {
      return success($platform);
  }
}
