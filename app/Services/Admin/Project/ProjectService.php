<?php

namespace App\Services\Admin\Project;
use App\Http\Requests\Api\Admin\Project\CreateProjectRequest;
use App\Http\Requests\Api\Admin\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class ProjectService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(Section $section, CreateProjectRequest $request)
    {
        $data = $request->validated();
        $data['logo'] = $data['logo']->storePublicly('projects/logo', 'public');
        $data['section_id'] = $section->id;
        $project = Project::create($data);
        if ($request->has('images')) {
            $imagesPath = array_map(function ($image) use ($project) {
                return [
                    'image' => $image->storePublicly('projects/images', 'public'),
                    'project_id' => $project->id
                ];
            }, $request->file('images'));

            if (!empty($imagesPath)) {
                $project->images()->createMany($imagesPath);
            }
        }
        return ProjectResource::make($project->load('images'));
    }

    public function update(Section $section, UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            if (Storage::exists("public/$project->logo")) {
                Storage::delete("public/$project->logo");
            }
            $data['logo'] = $data['logo']->storePublicly('projects/logo', 'public');
        }
        if ($request->has('images')) {
            $imagesPath = array_map(function ($image) use ($project) {
                return [
                    'image' => $image->storePublicly('projects/images', 'public'),
                    'project_id' => $project->id
                ];
            }, $request->file('images'));

            if (!empty($imagesPath)) {
                $project->images()->createMany($imagesPath);
            }
        }
        if (isset($data['delete_images'])) {
            $existingImagesCount = $project->images()->count();
            $deleteImagesCount = count($data['delete_images']);

            if ($existingImagesCount <= $deleteImagesCount) {
                throw new \Exception(__('messages.can_not_delete_image'), 422);
            }
            $imagesToDelete = $project->images()->whereIn('id', $data['delete_images'])->get();
            foreach ($imagesToDelete as $image) {
                if (Storage::exists("public/$image->image")) {
                    Storage::delete("public/$image->image");
                }
                $project->images()->where('id', $image->id)->delete();
            }
        }

        $project->update($data);
        return ProjectResource::make($project->load('images'));
    }
    public function destroy(Section $section, $project)
    {
        $project = Project::where('id', $project)->first();
        if (Storage::exists("public/$project->logo")) {
            Storage::delete("public/$project->logo");
        }
        $images = $project->images;
        foreach ($images as $image) {
            if (Storage::exists("public/$image->image")) {
                Storage::delete("public/$image->image");
            }
            $project->images()->where('id', $image->id)->delete();
        }
        $project->delete();

        return true;
    }
}
