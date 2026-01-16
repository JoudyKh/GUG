<?php

use App\Constants\Constants;
use App\Http\Controllers\Api\Admin\AboutUs\AboutUsController as AdminAboutUsController;
use App\Http\Controllers\Api\Admin\Article\ArticleController as AdminArticleController;
use App\Http\Controllers\Api\Admin\Client\ClientController as AdminClientController;
use App\Http\Controllers\Api\Admin\Consultation\ConsultationController;
use App\Http\Controllers\Api\Admin\Platform\PlatformController as AdminPlatformController;
use App\Http\Controllers\Api\Admin\Project\ProjectController as AdminProjectController;
use App\Http\Controllers\Api\Admin\ProjectDomain\ProjectDomainController as AdminProjectDomainController;
use App\Http\Controllers\Api\Admin\ProjectRequest\ProjectRequestController;
use App\Http\Controllers\Api\Admin\Review\ReviewController as AdminReviewController;
use App\Http\Controllers\Api\Admin\Slider\SliderController as AdminSliderController;
use App\Http\Controllers\Api\Admin\SubService\SubServiceController as AdminSubServiceController;
use App\Http\Controllers\Api\Admin\Technique\TechniqueController as AdminTechniqueController;
use App\Http\Controllers\Api\Admin\Workflow\WorkflowController as AdminWorkflowController;
use App\Http\Controllers\Api\General\AboutUs\AboutUsController;
use App\Http\Controllers\Api\General\Article\ArticleController;
use App\Http\Controllers\Api\General\Client\ClientController;
use App\Http\Controllers\Api\General\Platform\PlatformController;
use App\Http\Controllers\Api\General\Project\ProjectController;
use App\Http\Controllers\Api\General\ProjectDomain\ProjectDomainController;
use App\Http\Controllers\Api\General\Review\ReviewController;
use App\Http\Controllers\Api\General\Section\SectionController;
use App\Http\Controllers\Api\General\Slider\SliderController;
use App\Http\Controllers\Api\General\SubService\SubServiceController;
use App\Http\Controllers\Api\General\Technique\TechniqueController;
use App\Http\Controllers\Api\General\Workflow\WorkflowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\General\Info\InfoController;
use App\Http\Controllers\Api\Admin\Info\InfoController as AdminInfoController;
use App\Http\Controllers\Api\General\Auth\AuthController;
use App\Http\Controllers\Api\Admin\ContactMessage\ContactMessageController;
use App\Http\Controllers\Api\Admin\Section\SectionController as AdminSectionController;

/** @Auth */
Route::post('login', [AuthController::class, 'login'])->name('admin.login');//
Route::post('reset-password', [AuthController::class, 'resetPassword']);//
Route::post('send/verification-code', [AuthController::class, 'sendVerificationCode']);//
Route::post('check/verification-code', [AuthController::class, 'checkVerificationCode']);//

Route::group(['middleware' => ['auth:api', 'last.active', 'ability:' . Constants::ADMIN_ROLE]], function () {

    /** @Auth */
    Route::post('logout', [AuthController::class, 'logout']);//
    Route::get('/check/auth', [AuthController::class, 'authCheck']);//
    Route::get('profile', [AuthController::class, 'profile']);//
    Route::put('change-password', [AuthController::class, 'changePassword']);//
    Route::put('profile/update', [AuthController::class, 'updateProfile']);//


    Route::prefix('contact-messages')->group(function () {
        Route::get('/', [ContactMessageController::class, 'index']);//
        Route::delete('{contactMessage}', [ContactMessageController::class, 'delete']);//
    });

    Route::prefix('/domains')->group(function () {
        Route::get('/', [ProjectDomainController::class, 'index']);
        Route::post('/', [AdminProjectDomainController::class, 'store']);
        Route::get('/{domain}', [ProjectDomainController::class, 'show']);
        Route::put('/{domain}', [AdminProjectDomainController::class, 'update']);
        Route::delete('/{id}', [AdminProjectDomainController::class, 'destroy']);
    });
    Route::prefix('/clients')->group(function () {
        Route::get('/', [ClientController::class, 'index']);
        Route::post('/', [AdminClientController::class, 'store']);
        Route::get('/{client}', [ClientController::class, 'show']);
        Route::put('/{client}', [AdminClientController::class, 'update']);
        Route::delete('/{id}', [AdminClientController::class, 'destroy']);
    });
    Route::prefix('/techniques')->group(function () {
        Route::get('/', [TechniqueController::class, 'index']);
        Route::post('/', [AdminTechniqueController::class, 'store']);
        Route::get('/{technique}', [TechniqueController::class, 'show']);
        Route::put('/{technique}', [AdminTechniqueController::class, 'update']);
        Route::delete('/{id}', [AdminTechniqueController::class, 'destroy']);
    });
    Route::prefix('/workflows')->group(function () {
        Route::get('/', [WorkflowController::class, 'index']);
        Route::post('/', [AdminWorkflowController::class, 'store']);
        Route::get('/{workflow}', [WorkflowController::class, 'show']);
        Route::put('/{workflow}', [AdminWorkflowController::class, 'update']);
        Route::delete('/{id}', [AdminWorkflowController::class, 'destroy']);
    });
    Route::prefix('/about-us')->group(function () {
        Route::get('/', [AboutUsController::class, 'index']);
        Route::post('/', [AdminAboutUsController::class, 'store']);
        Route::get('/{about}', [AboutUsController::class, 'show']);
        Route::put('/{about}', [AdminAboutUsController::class, 'update']);
        Route::delete('/{id}', [AdminAboutUsController::class, 'destroy']);
    });
    Route::prefix('/platforms')->group(function () {
        Route::get('/', [PlatformController::class, 'index']);
        Route::post('/', [AdminPlatformController::class, 'store']);
        Route::get('/{platform}', [PlatformController::class, 'show']);
        Route::put('/{platform}', [AdminPlatformController::class, 'update']);
        Route::delete('/{id}', [AdminPlatformController::class, 'destroy']);
    });
    Route::prefix('/articles')->group(function () {
        Route::get('/', [ArticleController::class, 'index']);
        Route::post('/', [AdminArticleController::class, 'store']);
        Route::get('/{article}', [ArticleController::class, 'show']);
        Route::put('/{article}', [AdminArticleController::class, 'update']);
        Route::delete('/{id}', [AdminArticleController::class, 'destroy']);
    });
    
    Route::prefix('sections')->group(function () {
        /**
         * parent_id options :
         * empty for all section at the top layer
         * section id to get its sub sections .
         */
        Route::get('/', [SectionController::class, 'index']);//
        Route::post('/', [AdminSectionController::class, 'store']);//
        Route::prefix('/{section}')->group(function () {
            Route::get('/', [SectionController::class, 'show']);//
            Route::put('/', [AdminSectionController::class, 'update']);//
            Route::prefix('/sub-services')->group(function () {
                Route::get('/', [SubServiceController::class, 'index']);
                Route::post('/', [AdminSubServiceController::class, 'store']);
                Route::get('/{service}', [SubServiceController::class, 'show']);
                Route::put('/{service}', [AdminSubServiceController::class, 'update']);
                Route::delete('/{id}', [AdminSubServiceController::class, 'destroy']);
            });
            Route::prefix('/projects')->group(function () {
                Route::get('/', [ProjectController::class, 'index']);
                Route::post('/', [AdminProjectController::class, 'store']);
                Route::get('/{project}', [ProjectController::class, 'show']);
                Route::put('/{project}', [AdminProjectController::class, 'update']);
                Route::delete('/{id}', [AdminProjectController::class, 'destroy']);
            });
        });
        Route::delete('/{id}', [AdminSectionController::class, 'delete']);//
    });
    Route::prefix('infos')->group(function () {
        Route::get('/', [InfoController::class, 'index']);//
        Route::post('/update', [AdminInfoController::class, 'update']);//
    });
    Route::prefix('/project-requests')->group(function () {
        Route::get('/', [ProjectRequestController::class, 'index']);
        Route::get('/{request}', [ProjectRequestController::class, 'show']);
        Route::delete('/{request}/{force?}', [ProjectRequestController::class, 'destroy']);
        Route::get('/{request}/restore', [ProjectRequestController::class, 'restore']);
    });
    Route::prefix('/consultations')->group(function () {
        Route::get('/', [ConsultationController::class, 'index']);
        Route::get('/{consultation}', [ConsultationController::class, 'show']);
        Route::delete('/{consultation}/{force?}', [ConsultationController::class, 'destroy']);
        Route::get('/{consultation}/restore', [ConsultationController::class, 'restore']);
    });
    Route::prefix('/sliders/{type}')->group(callback: function () {
        Route::get('/', [SliderController::class, 'index']);
        Route::post('/', [AdminSliderController::class, 'store']);
        Route::put('/update', [AdminSliderController::class, 'update']);
    });
    Route::prefix('/reviews')->group(function () {
        Route::get('/', [ReviewController::class, 'index']);//
        Route::post('/', [AdminReviewController::class, 'store']);//
        Route::put('/{review}', [AdminReviewController::class, 'update']);//
        Route::delete('/{review}', [AdminReviewController::class, 'destroy']);//
    });
});

