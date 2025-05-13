<?php

namespace Made\Cms\Shared\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @extends Model
 *
 * @method static Builder query()
 * @method mixed getKey()
 */
interface RouteableContract
{
    /**
     * Defines a polymorphic one-to-one relation to the Route model.
     *
     * @return MorphOne The morph one relation instance.
     */
    public function route(): MorphOne;

    /**
     * Constructs the URL schema by traversing the hierarchy of parent objects.
     * The method modifies the provided array reference to include the slug of each parent object.
     *
     * @param  array  $parts  Reference to an array that accumulates the URL parts.
     *                        Defaults to an empty array.
     * @return array The array of URL parts including the slugs from the hierarchy.
     */
    public function urlSchema(array &$parts = []): array;

    /**
     * Returns the link name which can be presented within the link selection,
     */
    public function linkName(): string;

    /**
     * Returns a key which will be added in front of the link selection option.
     *
     * Example: page => page:1, post => post:1 etc.
     */
    public function linkKey(): string;

    /**
     * Returns the group name which will be used to group the link selection options.
     */
    public function linkGroupName(): string;

    /**
     * Selects the options which can be added to the link selects within Made.
     */
    public function scopeForLinkSelection(Builder $query): Builder;
}
