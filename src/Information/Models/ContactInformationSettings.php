<?php

declare(strict_types=1);

namespace Made\Cms\Information\Models;

use Exception;
use Made\Cms\Information\Data\Account;
use Made\Cms\Information\Data\Address;
use Made\Cms\Information\Data\Contact;
use Spatie\LaravelSettings\Settings;

class ContactInformationSettings extends Settings
{
    /**
     * @var string|null The name of the company. This can be null if no company is specified.
     */
    public ?string $company;

    public array $accounts = [];

    public array $addresses = [];

    public array $contacts = [];

    /**
     * Get the group name for the contact information settings.
     *
     * @return string The group name.
     */
    public static function group(): string
    {
        return 'information';
    }

    /**
     * Retrieves the account information.
     *
     * @param  string|null  $key  Optional key to specify which account information to retrieve.
     * @return Account The account information.
     */
    public function getAccount(string $key): Account
    {
        foreach ($this->accounts as $account) {
            if ($account['key'] === $key) {
                return Account::fromArray($account);
            }
        }

        throw new Exception("We couldn't find an account with the key {$key}.");
    }

    /**
     * Retrieves the address information.
     *
     * @param  string|null  $key  Optional key to specify a particular address.
     * @return Address The address information.
     */
    public function getAddress(?string $key = null): Address
    {
        if (! empty($key)) {
            foreach ($this->addresses as $address) {
                if ($address['key'] === $key) {
                    return Address::fromArray($address);
                }
            }

            throw new Exception("We couldn't find an address with the key {$key}.");
        }

        return Address::fromArray(array_shift($this->addresses));
    }

    /**
     * Retrieves contact information.
     *
     * @param  string|null  $key  Optional key to specify which contact information to retrieve.
     * @return Contact The contact information.
     */
    public function getContact(?string $key = null): Contact
    {
        if (! empty($key)) {
            foreach ($this->contacts as $contact) {
                if ($contact['key'] === $key) {
                    return Contact::fromArray($contact);
                }
            }

            throw new Exception("We couldn't find a contact with the key {$key}.");
        }

        return Contact::fromArray(array_shift($this->contacts));
    }
}
