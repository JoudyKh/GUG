<?php

namespace App\Services\Admin\Slider;
use App\Http\Requests\Api\Admin\Slider\CreateSliderRequest;
use App\Http\Requests\Api\Admin\Slider\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(CreateSliderRequest $request, $type)
    {
        if ($request->has('images')) {
            $imagesPath = array_map(function ($image) use ($type) {
                return [
                    'image' => $image->storePublicly('sliders/images', 'public'),
                    'type' => $type
                ];
            }, $request->file('images'));

            if (!empty($imagesPath)) {
                Slider::insert($imagesPath);
            }
        }
        $slidersGroupedByType = Slider::where('type', $type)
            ->get()
            ->groupBy('type');
        return $slidersGroupedByType;
    }
    public function update(UpdateSliderRequest $request, $type)
    {
        $data = $request->validated();
        if ($request->has('images')) {
            $imagesPath = array_map(function ($image) use ($type) {
                return [
                    'image' => $image->storePublicly('sliders/images', 'public'),
                    'type' => $type
                ];
            }, $request->file('images'));

            if (!empty($imagesPath)) {
                Slider::insert($imagesPath);
            }
        }
        if (isset($data['delete_images'])) {
            $sliderCount = Slider::where('type', $type)->count();
            $deleteImagesCount = count($data['delete_images']);

            $remainingImagesCount = $sliderCount - $deleteImagesCount;

            if ($remainingImagesCount = 1) {
                throw new \Exception(__('messages.can_not_delete_image'), 422);
            }

            $imagesToDelete = Slider::whereIn('id', $data['delete_images'])->get();
            foreach ($imagesToDelete as $image) {
                if (Storage::exists("public/{$image->image}")) {
                    Storage::delete("public/{$image->image}");
                }
                Slider::where('id', $image->id)->delete();
            }
        }
        $slidersGroupedByType = Slider::where('type', $type)
            ->get()
            ->groupBy('type');
        return $slidersGroupedByType;
    }
}
