<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Made\Cms\Database\HasDatabaseTablePrefix;

return new class extends Migration
{
    use HasDatabaseTablePrefix;

    public function up(): void
    {
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

    public function down(): void
    {
        Schema::dropIfExists($this->prefixTableName('settings'));
    }
};
