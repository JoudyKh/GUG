<?php

namespace App\Http\Requests\Api\App\Consultation;

use Illuminate\Foundation\Http\FormRequest;

/**  
 * @OA\Schema(  
 *     schema="CreateConsultationRequest",  
 *     type="object",  
 *     required={  
 *         "name",  
 *         "email",  
 *         "phone_number",  
 *         "description",  
 *         "subject"  
 *     },  
 *     @OA\Property(property="name", type="string", maxLength=255, example="John Doe"),  
 *     @OA\Property(property="email", type="string", maxLength=255, example="john.doe@example.com"),  
 *     @OA\Property(property="phone_number", type="string", maxLength=20, example="+1234567890"),  
 *     @OA\Property(property="description", type="string", example="This is a sample description."),  
 *     @OA\Property(property="subject", type="string", maxLength=255, example="Customer Inquiry"),  
 * )  
 */
class CreateConsultationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'phone_number' => 'required|string|max:255',
            'description' => 'required|string',
            'subject' => 'required|string',
        ];
    }
}
