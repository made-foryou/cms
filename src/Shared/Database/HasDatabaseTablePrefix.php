<?php

namespace Made\Cms\Shared\Database;

trait HasDatabaseTablePrefix
{
    /**
     * Prefixes the given table name with the configured database prefix.
     *
     * @param  string  $tableName  The table name to be prefixed.
     * @return string The prefixed table name.
     */
    public function prefixTableName(string $tableName): string
    {
        return config('made-cms.database.table_prefix') . $tableName;
    }
}
