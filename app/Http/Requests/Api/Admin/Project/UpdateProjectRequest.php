<?php

namespace App\Http\Requests\Api\Admin\Project;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="UpdateProjectRequest",  
 *     type="object",  
 *     @OA\Property(property="title", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="description"),  
 *     @OA\Property(property="logo", type="string", format="binary", example="image.jpg"),  
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
class UpdateProjectRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'description' => 'nullable',
            'images' => 'array',
            'images.*' => 'image|mimes:png,jpg,jpeg',
            'delete_images' => 'array',
            'delete_images.*' => 'exists:project_images,id,project_id,' . $this->route('project')->id,
        ];
    }
}
