<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;

return new class extends Migration
{
    use HasDatabaseTablePrefix;

    public const string TABLE = 'posts';

    public function up(): void
    {
        Schema::table($this->prefixTableName(self::TABLE), function (Blueprint $table) {
            $table->timestamp('date')
                ->default(now())
                ->after('slug');
        });
    }
};
