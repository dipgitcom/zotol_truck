<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('phone_number')->nullable();
        $table->text('short_bio')->nullable();
        $table->string('address')->nullable();
        $table->string('work_info')->nullable();
        $table->string('operate_truck')->nullable();
        $table->string('dot_license_file')->nullable();
        $table->boolean('dot_verified')->default(false);
        $table->float('height')->nullable();
        $table->string('height_unit', 10)->nullable();
        $table->float('weight')->nullable();
        $table->string('weight_unit', 10)->nullable();
        $table->string('gender')->nullable(); // or ->enum(...)
        $table->string('race')->nullable(); // or ->enum(...)
        $table->string('sexual_preferences')->nullable();
        $table->string('hiv_status')->nullable(); // or ->enum(...)
        $table->date('dob')->nullable();
        $table->string('relationship_status')->nullable(); // or ->enum(...)
        $table->text('social_links')->nullable();
        $table->string('role')->nullable();
        
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'phone_number', 'short_bio', 'address', 'work_info', 'operate_truck', 'dot_license_file', 'dot_verified',
            'height', 'height_unit', 'weight', 'weight_unit', 'gender', 'race', 'sexual_preferences', 'hiv_status',
            'dob', 'relationship_status', 'social_links', 'role'
        ]);
    });
}

};
