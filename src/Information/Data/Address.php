<?php

declare(strict_types=1);

namespace Made\Cms\Information\Data;

readonly class Address
{
    /**
     * Address constructor.
     *
     * Initializes a new instance of the Address class.
     */
    public function __construct(
        public string $key,
        public string $address,
        public string $zipcode,
        public string $city,
        public ?string $country,
    ) {
        //
    }

    /**
     * Creates an Address instance from an array.
     *
     * @param  array  $address  The array containing address data.
     * @return Address The Address instance created from the array.
     */
    public static function fromArray(array $address): Address
    {
        return new Address(
            $address['key'],
            $address['address'],
            $address['zipcode'],
            $address['city'],
            $address['country'] ?? null,
        );
    }
}
