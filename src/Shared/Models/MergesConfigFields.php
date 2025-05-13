<?php

declare(strict_types=1);

namespace Made\Cms\Shared\Models;

trait MergesConfigFields
{
    /**
     * Gather fields from the config according to the group value of the resource.
     */
    public function configFields(): array
    {
        $config = config('made-cms.settings.' . static::getSettings()::group(), []);

        if (empty($config)) {
            return [];
        }

        $fields = [];

        foreach ($config as $object) {
            if (is_string($object)) {
                $fields[] = (new $object)();
            } elseif (is_array($object)) {
                $fields = array_merge($fields, $object);
            }
        }

        return $fields;
    }
}
