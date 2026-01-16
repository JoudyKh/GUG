<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**  
 * @OA\Schema(  
 *     schema="AboutUsResource",  
 *     type="object",   
 *     @OA\Property(property="title", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="backgroun_color", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="description"),  
 *     @OA\Property(property="icon", type="string", format="binary", example="image.jpg"),  
 *     @OA\Property(property="image", type="string", format="binary", example="image.jpg"),  
 *     @OA\Property(property="offices[0][address]", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="offices[0][phone_number]", type="string", maxLength=255, example="Sample Name"),  
 * )  
 */
class AboutUsResource extends JsonResource
{
         /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed> | \Illuminate\Pagination\AbstractPaginator| \Illuminate\Http\Resources\Json\AnonymousResourceCollection
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
