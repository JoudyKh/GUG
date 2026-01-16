<?php

namespace App\Http\Controllers\Api\Admin\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Client\CreateClientRequest;
use App\Http\Requests\Api\Admin\Client\UpdateClientRequest;
use App\Models\Client;
use App\Services\Admin\Client\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService)
    {}
    /**
     * @OA\Post(
     *     path="/admin/clients",
     *     tags={"Admin" , "Admin - Client"},
     *     summary="Create a new Client",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateClientRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(CreateClientRequest $request)
    {
        try {
            $data = $this->clientService->store($request);
            return success($data, 201);

        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }
     /**
     * @OA\Post(
     *     path="/admin/clients/{id}",
     *     tags={"Admin" , "Admin - Client"},
     *     summary="update an existing Client",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="id",
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
     *             @OA\Schema(ref="#/components/schemas/UpdateClientRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            $data = $this->clientService->update($request, $client);
            return success($data);

        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }

    }
      /**
     * @OA\Delete(
     *     path="/admin/clients/{id}",
     *     tags={"Admin" , "Admin - Client"},
     *     summary="SoftDelete an existing Client",
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
    public function destroy($client)
    {
        try {
            $data = $this->clientService->destroy($client);
            return success($data);

        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }
}
