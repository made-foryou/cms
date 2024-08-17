<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('made-cms.database.table_prefix');

        Schema::create(
            $prefix . 'users',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        $prefix = config('made-cms.database.table_prefix');

        Schema::dropIfExists(
            $prefix . 'users',
        );
    }
};
