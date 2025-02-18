<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;

return new class extends Migration
{
    use HasDatabaseTablePrefix;

    public const string TABLE = 'menu_items';

    public function up(): void
    {
        if (Schema::hasTable($this->prefixTableName(self::TABLE))) {
            return;
        }

        Schema::create($this->prefixTableName(self::TABLE), function (Blueprint $table) {
            $table->id();

            $table->string('location')
                ->default('default');

            // Relation with the cms item.
            $table->nullableMorphs('linkable', 'menu_item_linkable');

            $table->string('link')
                ->nullable();

            $table->string('label')
                ->nullable();

            $table->string('title')
                ->nullable();

            $table->text('rel')
                ->nullable();

            $table->string('target')
                ->nullable();

            // Sorting
            $table->integer('index')
                ->default(0);

            $table->timestamps();
        });

        Schema::table($this->prefixTableName(self::TABLE), function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->nullable()
                ->after('id')
                ->references('id')
                ->on($this->prefixTableName(self::TABLE))
                ->nullOnDelete();
        });
    }
};
