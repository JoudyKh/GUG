<?php

namespace App\Http\Requests\Api\Admin\AboutUs;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="UpdateAboutUsRequest",  
 *     type="object",   
 *     @OA\Property(property="title", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="background_color", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="description"),  
 *     @OA\Property(property="icon", type="string", format="binary", example="image.jpg"),  
 *     @OA\Property(property="image", type="string", format="binary", example="image.jpg"),  
 *     @OA\Property(property="offices[0][address]", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="offices[0][phone_number]", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="delete_offices[0]", type="integer", example="1"),  
 * )  
 */

class UpdateAboutUsRequest extends FormRequest
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
            'icon' => 'nullable|image|mimes:png,jpg,jpeg',
            'title' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'description' => 'nullable|string',
            'background_color' => 'nullable|string',
            'offices' => 'array',
            'offices.*.address' => 'required|string',
            'offices.*.phone_number' => 'required|string',
            'delete_offices' => 'array',
            'delete_offices.*' => 'required|exists:offices,id,about_id,' . $this->route('about')->id,
        ];
    }
}
