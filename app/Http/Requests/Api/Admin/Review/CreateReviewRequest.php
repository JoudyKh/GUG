<?php

namespace App\Http\Requests\Api\Admin\Review;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="CreateReviewRequest",  
 *     type="object",  
 *     required={  
 *         "name",  
 *         "description",  
 *         "job_title"  
 *     },  
 *     @OA\Property(property="job_title", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="name", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="description"),  
 * )  
 */
class CreateReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'job_title' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
