<?php

declare(strict_types=1);

namespace Made\Cms\Information\Data;

readonly class Contact
{
    /**
     * Constructor for the Contact class.
     *
     * Initializes a new instance of the Contact class.
     */
    public function __construct(
        public string $key,
        public string $email,
        public string $phoneNumber,
        public ?string $phone,
        public ?string $contactPerson,
        public ?string $label,
    ) {
        //
    }

    /**
     * Creates a Contact instance from an array of data.
     *
     * @param  array  $data  The array of data to create the Contact instance from.
     * @return Contact The created Contact instance.
     */
    public static function fromArray(array $data): Contact
    {
        return new Contact(
            key: $data['key'],
            email: $data['email'],
            phoneNumber: $data['phoneNumber'],
            phone: $data['phone'] ?? null,
            contactPerson: $data['contactPerson'] ?? null,
            label: $data['label'] ?? null
        );
    }
}
