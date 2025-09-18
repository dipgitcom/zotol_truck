<?php

// database/migrations/xxxx_add_password_reset_otp_to_users.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password_reset_otp')->nullable();
            $table->timestamp('password_reset_expires_at')->nullable();
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['password_reset_otp', 'password_reset_expires_at']);
        });
    }
};
