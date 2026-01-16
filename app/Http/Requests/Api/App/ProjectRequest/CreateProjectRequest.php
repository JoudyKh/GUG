<?php

namespace App\Http\Requests\Api\App\ProjectRequest;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="CreateProjectRequest2",  
 *     type="object",  
 *     required={  
 *         "name",  
 *         "email",  
 *         "phone_number",  
 *         "description",  
 *         "project_domain_id",  
 *         "is_electronic_payment",  
 *         "is_shipping_service",  
 *     },  
 *     @OA\Property(property="name", type="string", maxLength=255, example="Sample Name"),  
 *     @OA\Property(property="email", type="string", maxLength=255, example="example@example.com"),  
 *     @OA\Property(property="phone_number", type="string", maxLength=20, example="+1234567890"),  
 *     @OA\Property(property="description", type="string", example="Project description goes here."),  
 *     @OA\Property(property="project_domain_id", type="integer", example=1),  
 *     @OA\Property(property="is_electronic_payment", enum={"0","1"}),  
 *     @OA\Property(property="is_shipping_service", enum={"0","1"}),  
 *     @OA\Property(property="platforms[0]", type="integer", example=1),  
 * )  
 */
class CreateProjectRequest extends FormRequest
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
            'email' => 'required|string',
            'phone_number' => 'required|string',
            'description' => 'required|string',
            'project_domain_id' => 'required|exists:project_domains,id',
            'is_electronic_payment' => 'required|boolean',
            'is_shipping_service' => 'required|boolean',
            'platforms' => 'required|array|min:1',
            'platforms.*' => 'required|exists:platforms,id'
        ];
    }
}
