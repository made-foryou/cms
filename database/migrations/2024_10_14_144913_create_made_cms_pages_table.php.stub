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
        Schema::create(
            table: config('made-cms.database.table_prefix') . 'pages',
            callback: function (Blueprint $table) {
                $table->id();

                $table->string('name');
                $table->string('slug');

                $table->foreignId('language_id')
                    ->nullable()
                    ->references('id')
                    ->on(config('made-cms.database.table_prefix') . 'languages')
                    ->nullOnDelete();

                $table->string('status')
                    ->default(
                        PublishingStatus::Draft->value
                    );

                $table->json('content');

                $table->integer('sort')
                    ->default(1);

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
            }
        );

        Schema::table(
            table: config('made-cms.database.table_prefix') . 'pages',
            callback: function (Blueprint $table) {
                $table->foreignId('parent_id')
                    ->nullable()
                    ->after('id')
                    ->references('id')
                    ->on(config('made-cms.database.table_prefix') . 'pages')
                    ->nullOnDelete();

                $table->foreignId('translated_from_id')
                    ->nullable()
                    ->after('parent_id')
                    ->references('id')
                    ->on(config('made-cms.database.table_prefix') . 'pages')
                    ->nullOnDelete();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(config('made-cms.database.table_prefix') . 'pages');
    }
};
