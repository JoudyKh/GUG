<?php

namespace App\Http\Controllers\Api\General\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Services\General\Client\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService)
    {
    }
    /**
     * @OA\Get(
     *     path="/clients",
     *     tags={"App" , "App - Client"},
     *     summary="get all clients",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     * @OA\Get(
     *     path="/admin/clients",
     *     tags={"Admin" , "Admin - Client"},
     *     summary="get all clients",
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
            return success($this->clientService->index());
        } catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
    /**
     * @OA\Get(
     *     path="/clients/{id}",
     *     tags={"App" , "App - Client"},
     *     summary="show one Client",
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
     *     path="/admin/clients/{id}",
     *     tags={"Admin" , "Admin - Client"},
     *     summary="show one Client",
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
    public function show(Client $client)
    {
        return success($client);
    }
}
