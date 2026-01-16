<?php

namespace App\Http\Requests\Api\Admin\Article;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="UpdateArticleRequest",  
 *     type="object",  
 *     @OA\Property(property="title", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="description", type="string", example="Sample Name"),  
 *     @OA\Property(property="image", type="string", format="binary", example="image.jpg"),  
 * )  
 */
class UpdateArticleRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'description' => 'nullable|string',
        ];
    }
}
