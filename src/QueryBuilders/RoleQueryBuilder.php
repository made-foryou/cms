<?php

namespace Made\Cms\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Made\Cms\Models\Role;

/**
 * @method Role first($columns = ['*'])
 * @method Collection<Role> get($columns = ['*'])
 */
class RoleQueryBuilder extends Builder
{
    /**
     * Sets the value of 'is_default' column to true in the given Query Builder instance.
     *
     * @return Builder The modified Query Builder instance.
     */
    public function default(): Builder
    {
        return $this->where('is_default', true);
    }
}
