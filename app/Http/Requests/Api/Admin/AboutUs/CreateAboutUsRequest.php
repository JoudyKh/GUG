<?php

namespace App\Http\Requests\Api\Admin\AboutUs;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="CreateAboutUsRequest",  
 *     type="object",  
 *     required={  
 *         "title",  
 *         "icon",  
 *         "background_color",  
 *     },  
 *     @OA\Property(property="title", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="background_color", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="description"),  
 *     @OA\Property(property="icon", type="string", format="binary", example="image.jpg"),  
 *     @OA\Property(property="image", type="string", format="binary", example="image.jpg"),  
 *     @OA\Property(property="offices[0][address]", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="offices[0][phone_number]", type="string", maxLength=255, example="Sample Name"),  
 * )  
 */
class CreateAboutUsRequest extends FormRequest
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
            'icon' => 'required|image|mimes:png,jpg,jpeg',
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'description' => 'nullable|string',
            'background_color' => 'required|string',
            'offices' => 'array',
            'offices.*.address' => 'required|string',
            'offices.*.phone_number' => 'required|string',
        ];
    }
}
