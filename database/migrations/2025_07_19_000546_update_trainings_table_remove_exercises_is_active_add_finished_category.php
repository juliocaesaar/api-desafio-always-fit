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
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn(['exercises', 'is_active']);
            
            $table->string('category')->after('duration_minutes');
            $table->boolean('finished')->default(false)->after('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn(['category', 'finished']);
            
            $table->json('exercises')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }
};
