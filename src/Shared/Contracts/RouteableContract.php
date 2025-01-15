<?php

namespace Made\Cms\Shared\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @extends Model
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
}
