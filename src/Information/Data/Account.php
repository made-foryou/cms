<?php

declare(strict_types=1);

namespace Made\Cms\Information\Data;

readonly class Account
{
    /**
     * Constructor for the Account class.
     *
     * Initializes a new instance of the Account class.
     */
    public function __construct(
        public string $key,
        public string $label,
        public string $account,
        public ?string $url,
    ) {}

    /**
     * Creates an Account instance from an array of data.
     *
     * @param  array  $data  The array containing account data.
     * @return Account The created Account instance.
     */
    public static function fromArray(array $data): Account
    {
        return new Account(
            $data['key'],
            $data['label'],
            $data['account'],
            $data['url'] ?? null,
        );
    }
}
