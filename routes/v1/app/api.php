<?php

use App\Http\Controllers\Api\App\Consultation\ConsultationController;
use App\Http\Controllers\Api\App\ProjectRequest\ProjectRequestController;
use App\Http\Controllers\Api\App\Review\ReviewController as AppReviewController;
use App\Http\Controllers\Api\General\AboutUs\AboutUsController;
use App\Http\Controllers\Api\General\Article\ArticleController;
use App\Http\Controllers\Api\General\Client\ClientController;
use App\Http\Controllers\Api\General\Platform\PlatformController;
use App\Http\Controllers\Api\General\Project\ProjectController;
use App\Http\Controllers\Api\General\ProjectDomain\ProjectDomainController;
use App\Http\Controllers\Api\General\Review\ReviewController;
use App\Http\Controllers\Api\General\Slider\SliderController;
use App\Http\Controllers\Api\General\SubService\SubServiceController;
use App\Http\Controllers\Api\General\Technique\TechniqueController;
use App\Http\Controllers\Api\General\Workflow\WorkflowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\General\Auth\AuthController;
use App\Http\Controllers\Api\General\Info\InfoController;
use App\Http\Controllers\Api\General\Section\SectionController;
use App\Http\Controllers\Api\App\Auth\AuthController as AppAuthController;
use App\Http\Controllers\Api\App\ContactMessage\ContactMessageController;
use App\Http\Controllers\Api\App\Home\HomeController;

/** @Auth */
Route::post('login', [AuthController::class, 'login'])->name('user.login');//
Route::post('register', [AppAuthController::class, 'register'])->name('user.register');//
Route::post('reset-password', [AuthController::class, 'resetPassword']);//
Route::post('send/verification-code', [AuthController::class, 'sendVerificationCode']);//
Route::post('check/verification-code', [AuthController::class, 'checkVerificationCode']);//


Route::prefix('sections')->group(function () {
    /**
     * parent_id options :
     * empty for all section at the top layer .
     * section id to get its sub sections .
     */
    Route::get('/', [SectionController::class, 'index']);//
    Route::prefix('/{section}')->group(function () {
        Route::get('/', [SectionController::class, 'show']);//
        Route::prefix('/sub-services')->group(function () {
            Route::get('/', [SubServiceController::class, 'index']);
            Route::get('/{service}', [SubServiceController::class, 'show']);
        });
        Route::prefix('/projects')->group(function () {
            Route::get('/', [ProjectController::class, 'index']);
            Route::get('/{project}', [ProjectController::class, 'show']);
        });
    });
});
Route::group(['middleware' => ['auth:api', 'last.active']], function () {
    /** @Auth */
    Route::post('logout', [AuthController::class, 'logout']);//
    Route::get('/check/auth', [AuthController::class, 'authCheck']);//
    Route::get('profile', [AuthController::class, 'profile']);//
    Route::put('change-password', [AuthController::class, 'changePassword']);//
    Route::put('profile/update', [AuthController::class, 'updateProfile']);//
});

/**@Guest */
Route::post('/contact-messages', [ContactMessageController::class, 'store']);//
Route::prefix('/domains')->group(function () {
    Route::get('/', [ProjectDomainController::class, 'index']);
    Route::get('/{domain}', [ProjectDomainController::class, 'show']);
});
Route::prefix('/clients')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/{client}', [ClientController::class, 'show']);

});
Route::prefix('/articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{article}', [ArticleController::class, 'show']);
});
Route::prefix('/infos')->group(function () {
    Route::get('/', [InfoController::class, 'index']);//
});
Route::prefix('/reviews')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);//
});
Route::prefix('/techniques')->group(function () {
    Route::get('/', [TechniqueController::class, 'index']);
    Route::get('/{technique}', [TechniqueController::class, 'show']);
});
Route::prefix('/workflows')->group(function () {
    Route::get('/', [WorkflowController::class, 'index']);
    Route::get('/{workflow}', [WorkflowController::class, 'show']);
});
Route::prefix('/about-us')->group(function () {
    Route::get('/', [AboutUsController::class, 'index']);
    Route::get('/{about}', [AboutUsController::class, 'show']);
});
Route::prefix('/platforms')->group(function () {
    Route::get('/', [PlatformController::class, 'index']);
    Route::get('/{platform}', [PlatformController::class, 'show']);
});
Route::prefix('/project-requests')->group(function () {
    Route::post('/', [ProjectRequestController::class, 'store']);
});
Route::prefix('/consultations')->group(function () {
    Route::post('/', [ConsultationController::class, 'store']);
});
Route::prefix('/sliders/{type}')->group(callback: function () {
    Route::get('/', [SliderController::class, 'index']);
});
Route::get('/home', [HomeController::class, 'index']);
