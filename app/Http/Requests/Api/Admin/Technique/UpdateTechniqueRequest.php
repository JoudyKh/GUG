<?php

namespace App\Http\Requests\Api\Admin\Technique;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="UpdateTechniqueRequest",  
 *     type="object",  
 *     title="File Upload Request",  
 *     description="Request body for uploading a file",  
 *     @OA\Property(  
 *         property="logo",  
 *         type="string",  
 *         format="binary",  
 *         description="The logo to be uploaded. Accepts image and video formats: jpeg, jpg, png, gif",  
 *         nullable=false  
 *     )  
 * )  
 */
class UpdateTechniqueRequest extends FormRequest
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
            'logo' => 'required|image|mimes:png,jpg,jpeg,gif',

        ];
    }
}
