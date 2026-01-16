<?php

namespace App\Services\Admin\AboutUs;
use App\Http\Requests\Api\Admin\AboutUs\CreateAboutUsRequest;
use App\Http\Requests\Api\Admin\AboutUs\UpdateAboutUsRequest;
use App\Http\Resources\AboutUsResource;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Storage;

class AboutUsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(CreateAboutUsRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image'))
            $data['image'] = $data['image']->storePublicly('about/images', 'public');
        $data['icon'] = $data['icon']->storePublicly('about/icon', 'public');
        $about = AboutUs::create($data);
        if (isset($data['offices'])) {
            $about->offices()->createMany($data['offices']);
        }
        return AboutUsResource::make($about->load('offices'));
    }

    public function update(UpdateAboutUsRequest $request, AboutUs $about)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if (Storage::exists("public/$about->image")) {
                Storage::delete("public/$about->image");
            }
            $data['image'] = $data['image']->storePublicly('about/images', 'public');
        }
        if ($request->hasFile('icon')) {
            if (Storage::exists("public/$about->icon")) {
                Storage::delete("public/$about->icon");
            }
            $data['icon'] = $data['icon']->storePublicly('about/icon', 'public');
        }
        if (isset($data['offices'])) {
            $about->offices()->createMany($data['offices']);
        }
        if (isset($data['delete_offices'])) {
            $about->offices()->whereIn('id', $data['delete_offices'])->delete();
        }
        $about->update($data);
        $about = AboutUs::find($about->id);
        return AboutUsResource::make($about->load('offices'));
    }
    public function destroy($about)
    {
        $about = AboutUs::where('id', $about)->first();
        if (Storage::exists("public/$about->image")) {
            Storage::delete("public/$about->image");
        }
        if (Storage::exists("public/$about->icon")) {
            Storage::delete("public/$about->icon");
        }
        $about->delete();

        return true;
    }

}
