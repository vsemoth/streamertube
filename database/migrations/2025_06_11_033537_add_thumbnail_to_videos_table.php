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
        Schema::table('videos', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->string('thumbnail')->nullable()->after('is_monetizable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropColumn('thumbnail');
        });
    }
};
