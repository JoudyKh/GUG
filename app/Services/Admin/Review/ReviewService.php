<?php

namespace App\Services\Admin\Review;
use App\Http\Requests\Api\Admin\Review\CreateReviewRequest;
use App\Http\Requests\Api\Admin\Review\UpdateReviewRequest;
use App\Models\Review;

class ReviewService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(CreateReviewRequest $request)
    {
        $data = $request->validated();
        return Review::create($data);
    }
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $data = $request->validated();
        $review->update($data);
        return $review;
    }
    public function destroy(Review $review)
    {
        $review->delete();
        return true;
    }
}
