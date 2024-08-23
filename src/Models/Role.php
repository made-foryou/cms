<?php

namespace Made\Cms\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Made\Cms\Database\Factories\RoleFactory;
use Made\Cms\Database\HasDatabaseTablePrefix;

/**
 * ### Role
 *
 * The role model which is being used for the cms roles.
 *
 * @property-read int $id
 * @property string $name
 * @property string|null $description
 * @property boolean $is_default
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static Role create(array $attributes = [])
 */
class Role extends Model
{
    use HasDatabaseTablePrefix;
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'is_default' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Make the current role the default role.
     *
     * This method sets the 'is_default' property of the current role to true
     * and saves the changes to the database. It also updates the
     * 'is_default' property of all other roles to false.
     *
     * This function will reset the current default role, as there can only
     * be one default role.
     *
     * @return void
     */
    public function makeDefault(): void
    {
        Role::query()
            ->where('is_default', true)
            ->update(['is_default' => false]);

        $this->is_default = true;
        $this->save();
    }

    /**
     * Retrieves the prefixed table name.
     *
     * This method returns the prefixed table name by calling the `prefixTableName` method with the current table name as the argument.
     *
     * @return string The prefixed table name.
     */
    public function getTable(): string
    {
        return $this->prefixTableName('roles');
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): RoleFactory
    {
        return RoleFactory::new();
    }
}
