<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;
use Made\Cms\Shared\Enums\PublishingStatus;

return new class extends Migration
{
    use HasDatabaseTablePrefix;

    public function up(): void
    {
        Schema::create($this->prefixTableName('posts'), function (Blueprint $table) {
            $table->id();

            $table->foreignId('language_id')
                ->nullable()
                ->references('id')
                ->on($this->prefixTableName('languages'))
                ->nullOnDelete();

            $table->string('name');
            $table->string('slug');

            $table->string('status')
                ->default(
                    PublishingStatus::Draft->value
                );

            $table->json('content');

            /**
             * Filled as soon as the model is saved. This tracks who
             * modified/created this part.
             */
            $table->foreignId('created_by')
                ->references('id')
                ->on($this->prefixTableName('users'))
                ->restrictOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            table: $this->prefixTableName('posts'),
            callback: function (Blueprint $table) {
                $table->foreignId('translated_from_id')
                    ->nullable()
                    ->after('language_id')
                    ->references('id')
                    ->on($this->prefixTableName('posts'))
                    ->nullOnDelete();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefixTableName('posts'));
    }
};
