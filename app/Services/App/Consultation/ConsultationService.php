<?php

namespace App\Services\App\Consultation;
use App\Http\Requests\Api\App\Consultation\CreateConsultationRequest;
use App\Models\Consultation;

class ConsultationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(CreateConsultationRequest $request)
    {
        $data = $request->validated();
        return Consultation::create($data);
    }
}
