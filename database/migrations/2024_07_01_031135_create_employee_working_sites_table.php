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
        Schema::create('employee_working_sites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_information_id');
            $table->bigInteger('working_site_id');
            $table->string('job_title', 120)->nullable();
            $table->string('job_title_rate', 11)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_working_sites');
    }
};
