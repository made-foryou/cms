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
        if (Schema::hasTable($this->prefixTableName('roles'))) {
            return;
        }

        Schema::create(
            $this->prefixTableName('roles'),
            function (Blueprint $table) {
                $table->id();

                $table->string('name');
                $table->text('description')->nullable();
                $table->boolean('is_default')->default(false);

                $table->timestamps();
                $table->softDeletes();
            }
        );

        Schema::create(
            $this->prefixTableName('permissions'),
            function (Blueprint $table) {
                $table->id();

                $table->string('key');
                $table->string('subject');
                $table->string('name')->nullable();
                $table->text('description')->nullable();

                $table->unique(['key', 'subject'], 'uk_p_key_subject');

                $table->timestamps();
            }
        );

        Schema::create(
            $this->prefixTableName('permission_role'),
            function (Blueprint $table) {
                $table->foreignId('role_id')
                    ->references('id')
                    ->on($prefix . 'roles')
                    ->cascadeOnDelete();

                $table->foreignId('permission_id')
                    ->references('id')
                    ->on($prefix . 'permissions')
                    ->cascadeOnDelete();
            }
        );

        Schema::table(
            $this->prefixTableName('users'),
            function (Blueprint $table) {
                $table->unsignedBigInteger('role_id')
                    ->after('id');

                $table->foreign('role_id', 'fk_u_role_id')
                    ->references('id')
                    ->on($prefix . 'roles')
                    ->restrictOnDelete();

                $table->softDeletes()
                    ->after('updated_at');
            }
        );
    }
};
