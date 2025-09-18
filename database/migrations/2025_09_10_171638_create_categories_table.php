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
    Schema::table('categories', function (Blueprint $table) {
        if (!Schema::hasColumn('categories', 'slug')) {
            $table->string('slug')->unique()->after('name');
        }
        if (!Schema::hasColumn('categories', 'image')) {
            $table->string('image')->nullable()->after('slug');
        }
        if (!Schema::hasColumn('categories', 'status')) {
            $table->boolean('status')->default(1)->after('image');
        }
    });
}

public function down(): void
{
    Schema::table('categories', function (Blueprint $table) {
        $table->dropColumn(['slug', 'image', 'status']);
    });
}
};
