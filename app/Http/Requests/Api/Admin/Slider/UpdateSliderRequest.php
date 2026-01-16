<?php

namespace App\Http\Requests\Api\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="UpdateSliderRequest",  
 *     type="object",  
 *     title="File Upload Request",  
 *     description="Request body for uploading a file",  
 *     @OA\Property(  
 *         property="images[0]",  
 *         type="string",  
 *         format="binary",  
 *         description="The logo to be uploaded. Accepts image : jpeg, jpg, png",  
 *         nullable=false  
 *     ),  
 *     @OA\Property(  
 *         property="delete_images[0]",  
 *         type="integer",  
 *         description="The logo to be uploaded. Accepts image : jpeg, jpg, png",  
 *         nullable=false  
 *     ),  
 * )  
 */
class UpdateSliderRequest extends FormRequest
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
            'images' => 'array|min:1',
            'images.*' => 'required|image|mimes:png,jpg,jpeg',
            'delete_images' => 'array',
            'delete_images.*' => 'required|exists:sliders,id'
        ];
    }
}
