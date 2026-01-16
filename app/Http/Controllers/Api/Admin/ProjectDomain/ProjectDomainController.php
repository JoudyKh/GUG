<?php

namespace App\Http\Controllers\Api\Admin\ProjectDomain;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\ProjectDomain\CreateDomainRequest;
use App\Http\Requests\Api\Admin\ProjectDomain\UpdateDomainRequest;
use App\Models\ProjectDomain;
use App\Services\Admin\ProjectDomain\ProjectDomainService;
use Illuminate\Http\Request;

class ProjectDomainController extends Controller
{
    public function __construct(protected ProjectDomainService $projectDomainService)
    {}
    
    /**
     * @OA\Post(
     *     path="/admin/domains",
     *     tags={"Admin" , "Admin - ProjectDomain"},
     *     summary="Create a new ProjectDomain",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateDomainRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     )
     * )
     */
    public function store(CreateDomainRequest $request)
    {

        try {
            $data = $this->projectDomainService->store($request);
            return success($data, 201);

        } catch (\Throwable $th) {
            return error($th->getMessage(), [$th->getMessage()], $th->getCode());
        }
    }

     /**
     * @OA\Post(
     *     path="/admin/domains/{domain}",
     *     tags={"Admin" , "Admin - ProjectDomain"},
     *     summary="update an existing  ProjectDomain",
     *      security={{ "bearerAuth": {}, "Accept": "json/application" }},
     *     @OA\Parameter(
     *         name="domain",
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
     *             @OA\Schema(ref="#/components/schemas/UpdateDomainRequest") ,
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function update(UpdateDomainRequest $request, ProjectDomain $domain)
    {
        try {
            return success($this->projectDomainService->update( $request, $domain));
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
      /**
     * @OA\Delete(
     *     path="/admin/domains/{id}",
     *     tags={"Admin" , "Admin - ProjectDomain"},
     *     summary="SoftDelete an existing ProjectDomain",
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
    public function destroy($domain)
    {
        try {
            return success($this->projectDomainService->destroy($domain));
        }  catch (\Exception $e) {
            return error($e->getMessage(), [$e->getMessage()], $e->getCode());
        }
    }
}
