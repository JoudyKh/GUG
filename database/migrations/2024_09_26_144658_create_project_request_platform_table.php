<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_request_platform', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_request_id')
            ->constrained('project_requests')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId('platform_id')
            ->constrained('platforms')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_request_platform');
    }
};
