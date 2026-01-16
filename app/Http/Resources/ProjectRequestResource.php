<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**  
 * @OA\Schema(  
 *     schema="ProjectRequestResource",  
 *     type="object",   
 *     @OA\Property(property="name", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="email", type="string", maxLength=255, example="example@example.com"),  
 *     @OA\Property(property="phone_number", type="string", maxLength=20, example="+1234567890"),  
 *     @OA\Property(property="description", type="string", example="Project description goes here."),  
 *     @OA\Property(property="project_domain_id", type="integer", example=1),  
 *     @OA\Property(property="is_electronic_payment", enum={"0","1"}),  
 *     @OA\Property(property="is_shipping_service", enum={"0","1"}),  
 *     @OA\Property(property="platforms[0]", type="integer", example=1),  
 * )  
 */
class ProjectRequestResource extends JsonResource
{
   /**
     * Transform the resource into an array.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Pagination\AbstractPaginator
     */
    public static function collection($data)
    {
        /*
        This simply checks if the given data is and instance of Laravel's paginator classes
         and if it is,
        it just modifies the underlying collection and returns the same paginator instance
        */
        if (is_a($data, \Illuminate\Pagination\AbstractPaginator::class)) {
            $data->setCollection(
                $data->getCollection()->map(function ($listing) {
                    return new static($listing);
                })
            );
            return $data;
        }

        return parent::collection($data);
    }
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
