<?php

namespace App\Services\General\Slider;
use App\Models\Slider;

class SliderService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index($type)
    {
        $slidersGroupedByType = Slider::where('type', $type)
            ->get()
            ->groupBy('type');
        return $slidersGroupedByType;
    }
}
