<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;
use Made\Cms\Shared\Enums\MetaRobot;

return new class extends Migration
{
    use HasDatabaseTablePrefix;

    public function up(): void
    {
        if (Schema::hasTable($this->prefixTableName('meta'))) {
            return;
        }

        Schema::create($this->prefixTableName('meta'), function (Blueprint $table) {
            $table->id();

            $table->morphs('describable');

            $table->string('title')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->string('robot')
                ->default(MetaRobot::IndexAndFollow->value);

            $table->text('canonicals')
                ->nullable();

            $table->timestamps();
        });
    }
};
