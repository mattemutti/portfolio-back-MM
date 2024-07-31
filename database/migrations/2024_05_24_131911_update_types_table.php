<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('types', function (Blueprint $table) {
            $table->string('cover_image')->nullable()->after('name');
            $table->text('description')->nullable()->before('slug');
            $table->string('version')->nullable()->before('description');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('types', function (Blueprint $table) {
            $table->dropColumn('cover_image');
            $table->dropColumn('description');
            $table->dropColumn('version');
        });
    }
};
