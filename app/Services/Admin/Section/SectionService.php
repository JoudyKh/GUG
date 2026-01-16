<?php

namespace App\Services\Admin\Section;
use App\Http\Requests\Api\Admin\Section\StoreSectionRequest;
use App\Http\Requests\Api\Admin\Section\UpdateSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class SectionService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function store(StoreSectionRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->storePublicly('sections/logo', 'public');
        }
        $section = Section::create($data);
        if ($request->has('images')) {
            $imagesPath = array_map(function ($image) use ($section) {
                return [
                    'image' => $image->storePublicly('sections/images', 'public'),
                    'section_id' => $section->id
                ];
            }, $request->file('images'));

            if (!empty($imagesPath)) {
                $section->images()->createMany($imagesPath);
            }
        }
        return SectionResource::make($section->load('images'));
    }
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            if (Storage::exists("public/$section->logo")) {
                Storage::delete("public/$section->logo");
            }
            $data['logo'] = $request->file('logo')->storePublicly('sections/logo', 'public');
        }
        if ($request->has('images')) {
            $imagesPath = array_map(function ($image) use ($section) {
                return [
                    'image' => $image->storePublicly('sections/images', 'public'),
                    'section_id' => $section->id
                ];
            }, $request->file('images'));

            if (!empty($imagesPath)) {
                $section->images()->createMany($imagesPath);
            }
        }
        if (isset($data['delete_images'])) {
            $existingImagesCount = $section->images()->count();
            $deleteImagesCount = count($data['delete_images']);
            
            if ($existingImagesCount <= $deleteImagesCount) {
                throw new \Exception(__('messages.can_not_delete_image'), 422);
            }
            $imagesToDelete = $section->images()->whereIn('id', $data['delete_images'])->get();
            foreach ($imagesToDelete as $image) {
                if (Storage::exists("public/$image->image")) {
                    Storage::delete("public/$image->image");
                }
                $section->images()->where('id', $image->id)->delete();
            }
        }
   
        $section->update($data);
        return SectionResource::make($section->load('images'));
    }
    public function delete($id)
    {
        $section = Section::findOrFail($id);
        if (Storage::exists("public/$section->logo")) {
            Storage::delete("public/$section->logo");
        }   
        $images = $section->images;  
            foreach ($images as $image) {  
                if (Storage::exists("public/$image->image")) {  
                    Storage::delete("public/$image->image");  
                }  
                $section->images()->where('id', $image->id)->delete();  
            }  
          
        $section->delete();
        return true;
    }

}
