<?php

namespace App\Http\Requests\Api\Admin\SubService;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="CreateSubServiceRequest",  
 *     type="object",  
 *     required={  
 *         "title",  
 *         "description",  
 *         "logo"  
 *     },  
 *     @OA\Property(property="title", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="description"),  
 *     @OA\Property(property="logo", type="string", format="binary", example="image.jpg"),  
 * )  
 */
class CreateSubServiceRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'description' => 'required',
        ];
    }
}
