<?php

namespace App\Http\Controllers\Api\App\Home;

use App\Http\Controllers\Controller;
use App\Models\Info;
use App\Services\App\Home\HomeService;
use App\Services\General\Info\InfoService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected HomeService $homeService, protected InfoService $infoService)
    {}
      /**
     * @OA\Get(
     *     path="/home",
     *     tags={"App" , "App - Home"},
     *     summary="Get home index",
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function index()
    {
        $infos = $this->infoService->getAll();
        return success($this->homeService->index(), 200, ['infos' => $infos]);
    }
}
