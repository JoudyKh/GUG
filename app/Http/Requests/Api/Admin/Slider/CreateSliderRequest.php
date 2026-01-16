<?php

namespace App\Http\Requests\Api\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="CreateSliderRequest",  
 *     type="object",  
 *     title="File Upload Request",  
 *     description="Request body for uploading a file",  
 *     @OA\Property(  
 *         property="images[0]",  
 *         type="string",  
 *         format="binary",  
 *         description="The logo to be uploaded. Accepts image : jpeg, jpg, png",  
 *         nullable=false  
 *     )  
 * )  
 */
class CreateSliderRequest extends FormRequest
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
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:png,jpg,jpeg'
        ];
    }
}
