<?php

namespace App\Services\Admin\Consultation;
use App\Constants\Constants;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index(Request $request)
    {
        $consultations = Consultation::orderByDesc($request->trash ? 'deleted_at' : 'created_at');
        if ($request->has('trash') && $request->input('trash') == 1 && Auth::user()?->hasRole(Constants::ADMIN_ROLE)) {
            $consultations->onlyTrashed();
        }
        $consultations = $consultations->paginate(config('app.pagination_limit'));
        return $consultations;
    }
    public function show(Consultation $consultation)
    {
        return $consultation;
    }
    public function destroy($consultation, $force = null)
    {
        if ($force) {
            $consultation = Consultation::onlyTrashed()->findOrFail($consultation);
            $consultation->forceDelete();
        } else {
            $consultation = Consultation::where('id', $consultation)->first();
            $consultation->delete();
        }
        return true;
    }
    public function restore($consultation)
    {
        $consultation = Consultation::withTrashed()->find($consultation);
        if ($consultation && $consultation->trashed()) {
            $consultation->restore();
            return true;
        }
        throw new \Exception(__('messages.not_found'), 404);
    }
}
