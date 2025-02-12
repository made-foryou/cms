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
        if (Schema::hasTable($this->prefixTableName('settings'))) {
            return;
        }

        Schema::create(
            $this->prefixTableName('settings'),
            function (Blueprint $table): void {
                $table->id();

                $table->string('group');
                $table->string('name');
                $table->boolean('locked')->default(false);
                $table->json('payload');

                $table->timestamps();

                $table->unique(['group', 'name']);
            }
        );
    }
};
