<?php

namespace App\Http\Requests;

use App\Models\Info;
use App\Rules\OneOrNone;
use Illuminate\Validation\Rule;
use App\Constants\InfoValidationRules;
use Illuminate\Foundation\Http\FormRequest;


/**  
 * @OA\Schema(  
 *     schema="UpdateInfoRequest",  
 *     type="object",  
 *     @OA\Property(property="hero-logo", type="string", format="binary", description="Upload the hero logo image", example="hero-logo.png"),  
 *     @OA\Property(property="hero-image", type="string", format="binary", description="Upload the hero image", example="hero-image.png"),  
 *     @OA\Property(property="hero-company_description", type="string", description="The name of the company", example="Company ABC"),  
 *     @OA\Property(property="hero-successful_projects", type="string", description="Number of successful projects", example="150"),  
 *     @OA\Property(property="hero-experience_years", type="string", description="Years of experience", example="10"),  
 *     @OA\Property(property="hero-clients", type="string", description="Number of clients", example="1000"),  
 *     @OA\Property(property="hero-development_hours", type="string", description="Total development hours", example="5000"),  
 *     @OA\Property(property="about-image", type="string", format="binary", description="Upload the about section image", example="about-image.png"),  
 *     @OA\Property(property="about-about_us", type="string", description="Information about the company", example="We are a leading firm in the industry."),  
 *     @OA\Property(property="about-rights", type="string", description="All rights reserved notice", example="© 2023 Company ABC. All rights reserved."),  
 *     @OA\Property(property="about-phone_number", type="string", description="Contact phone number", example="+1234567890"),  
 *     @OA\Property(property="about-email", type="string", format="email", description="Contact email address", example="info@companyabc.com"),  
 *     @OA\Property(property="about-whatsapp", type="string", format="url", description="WhatsApp link", example="https://wa.me/1234567890"),  
 *     @OA\Property(property="about-youtube", type="string", format="url", description="YouTube channel link", example="https://www.youtube.com/channel/XYZ"),  
 *     @OA\Property(property="about-linkedIn", type="string", format="url", description="LinkedIn profile link", example="https://www.linkedin.com/in/companyabc"),  
 *     @OA\Property(property="about-twitter", type="string", format="url", description="Twitter profile link", example="https://twitter.com/companyabc"),  
 *     @OA\Property(property="about-facebook", type="string", format="url", description="Facebook page link", example="https://www.facebook.com/companyabc"),  
 *     @OA\Property(property="about-instagram", type="string", format="url", description="Instagram profile link", example="https://www.instagram.com/companyabc"),  
 *     @OA\Property(property="about-telegram", type="string", format="url", description="Telegram channel link", example="https://t.me/companyabc"),  
 * )  
 */
class UpdateInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request-
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request-
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hero-logo' => ['image', 'mimes:png,jpg,jpeg'],
            'hero-image' => ['image', 'mimes:png,jpg,jpeg'],
            'hero-company_description' => ['string'],
            'hero-successful_projects' => ['string'],
            'hero-experience_years' => ['string'],
            'hero-clients' => ['string'],
            'hero-development_hours' => ['string'],
            'about-image' => ['image', 'mimes:png,jpg,jpeg'],
            'about-about_us' => ['string'],
            'about-rights' => ['string'],
            'about-phone_number' => ['string'],
            'about-email' => ['string', 'email'],
            'about-whatsapp' => ['string' , 'url'] , 
            'about-youtube' => ['string' , 'url'] , 
            'about-linkedIn' => ['string' , 'url'] , 
            'about-twitter' => ['string' , 'url'] , 
            'about-facebook' => ['string' , 'url'] , 
            'about-instagram' => ['string' , 'url'] , 
            'about-telegram' => ['string' , 'url'] , 
        ];
    }
}
