<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;

return new class extends Migration
{
    use HasDatabaseTablePrefix;

    public function up(): void
    {
        if (Schema::hasTable($this->prefixTableName('languages'))) {
            return;
        }

        Schema::create($this->prefixTableName('languages'), function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('country')->nullable();
            $table->string('locale');
            $table->string('abbreviation');

            $table->boolean('is_default')->default(false);
            $table->boolean('is_enabled')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }
};
