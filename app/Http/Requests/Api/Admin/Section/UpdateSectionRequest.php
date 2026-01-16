<?php

namespace App\Http\Requests\Api\Admin\Section;

use App\Constants\Constants;
use App\Traits\HandlesValidationErrorsTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
{
    use HandlesValidationErrorsTrait;

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
    public function rules()
    {
        return array_merge(
            Constants::SECTIONS_TYPES[$this->route('section')->type]['rules']['update'],
            [
                'images' => 'array',
                'images.*' => 'image|mimes:png,jpg,jpeg',
                'delete_images' => 'array',
                'delete_images.*' => 'exists:section_images,id,section_id,' . $this->route('section')->id,
            ]
        );
    }
    public function messages()
    {
        return array_merge(
            [
                'images.array' => 'The images must be an array.',
                'images.*.image' => 'Each image must be an image file.',
                'images.*.mimes' => 'Each image must be a file of type: png, jpg, jpeg.',
                'delete_images.array' => 'The delete images must be an array.',
                'delete_images.*.exists' => 'One or more images to delete do not exist in the database for this section.',
            ]
        );
    }
}
