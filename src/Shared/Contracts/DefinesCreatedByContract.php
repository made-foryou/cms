<?php

namespace Made\Cms\Shared\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int|null $created_by
 *
 * @extends Model
 */
interface DefinesCreatedByContract
{
    /**
     * Defines the relationship between this model and the User model.
     *
     * This method establishes a "belongs to" relationship, indicating that this model is associated with an instance of the User model through the 'author' foreign key.
     *
     * @return BelongsTo The relationship instance between this model and the User model.
     */
    public function createdBy(): BelongsTo;
}
