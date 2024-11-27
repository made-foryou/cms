<?php

namespace Made\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $name
 * @property string|null $country
 * @property string $locale
 * @property string $abbreviation
 * @property string|null $image
 * @property bool $is_default
 * @property bool $is_enabled
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 */
class Language extends Model
{
    protected $fillable = [
        'name',
        'country',
        'locale',
        'abbreviation',
        'image',
        'is_default',
        'is_enabled',
    ];

    protected $casts = [
        'id' => 'integer',
        'is_default' => 'boolean',
        'is_enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Sets the current language instance as the default language.
     */
    public function makeDefault(): void
    {
        Language::query()
            ->where('is_default', true)
            ->update(['is_default' => false]);

        $this->is_default = true;
        $this->save();
    }

    /**
     * Retrieves the table name with the applied prefix from the configuration.
     */
    public function getTable(): string
    {
        return config('made-cms.database.table_prefix') . 'languages';
    }
}
