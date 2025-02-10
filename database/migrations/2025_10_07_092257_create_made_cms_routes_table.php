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
        if (Schema::hasTable($this->prefixTableName('routes'))) {
            return;
        }

        Schema::create($this->prefixTableName('routes'), function (Blueprint $table) {
            $table->id();

            $table->morphs('routeable');

            $table->string('route');

            $table->timestamps();
        });
    }
};
