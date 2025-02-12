<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;

return new class extends Migration
{
    use HasDatabaseTablePrefix;

    public const string TABLE_NAME = 'visits';

    public function up(): void
    {
        if (Schema::hasTable($this->prefixTableName(self::TABLE_NAME))) {
            return;
        }

        Schema::create(
            $this->prefixTableName(self::TABLE_NAME),
            function (Blueprint $table) {
                $table->id();

                $table->string('session')
                    ->index();

                $table->foreignId('user_id')
                    ->nullable()
                    ->references('id')
                    ->on($this->prefixTableName('users'))
                    ->nullOnDelete();

                $table->string('user_agent');

                $table->string('browser')
                    ->nullable();

                $table->string('browser_version')
                    ->nullable();

                $table->string('platform')
                    ->nullable();

                $table->boolean('is_desktop')
                    ->default(true);

                $table->string('referer')
                    ->nullable();

                $table->string('request')
                    ->nullable();

                $table->foreignId('route_id')
                    ->nullable()
                    ->references('id')
                    ->on($this->prefixTableName('routes'))
                    ->nullOnDelete();

                $table->string('response_code')
                    ->nullable();

                $table->timestamps();
            }
        );
    }
};
