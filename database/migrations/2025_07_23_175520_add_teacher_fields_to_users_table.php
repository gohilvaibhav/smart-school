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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('password');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('mobile');
            $table->string('birth_date')->nullable()->after('gender');
            $table->string('qualification')->nullable()->after('birth_date');
            $table->string('experience')->nullable()->after('qualification');
            $table->string('profile_photo')->nullable()->after('experience');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
