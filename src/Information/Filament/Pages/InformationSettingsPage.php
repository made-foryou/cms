<?php

declare(strict_types=1);

namespace Made\Cms\Information\Filament\Pages;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;
use Made\Cms\Information\Models\ContactInformationSettings;

class InformationSettingsPage extends SettingsPage
{
    protected static string $settings = ContactInformationSettings::class;

    protected static ?int $navigationSort = 10;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('made-cms::cms.resources.settings.information.sections.company.title'))
                    ->description(__('made-cms::cms.resources.settings.information.sections.company.description'))
                    ->aside()
                    ->schema([
                        TextInput::make('company')
                            ->label(__('made-cms::cms.resources.settings.information.fields.company.label')),
                    ]),

                Section::make(__('made-cms::cms.resources.settings.information.sections.address.title'))
                    ->description(__('made-cms::cms.resources.settings.information.sections.address.description'))
                    ->aside()
                    ->schema([
                        Repeater::make('addresses')
                            ->label('')
                            ->schema([
                                TextInput::make('key')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.key.label'))
                                    ->live(onBlur: true)
                                    ->required(),

                                TextInput::make('address')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.address.label'))
                                    ->required(),

                                TextInput::make('zipcode')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.zipcode.label'))
                                    ->required(),

                                TextInput::make('city')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.city.label'))
                                    ->required(),

                                TextInput::make('country')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.country.label')),
                            ])
                            ->addActionLabel(__('made-cms::cms.resources.settings.information.fields.addresses.actionLabel'))
                            ->minItems(1)
                            ->itemLabel(fn (array $state): ?string => $state['key'] ?? null)
                            ->collapsed(), 
                    ]),

                Section::make(__('made-cms::cms.resources.settings.information.sections.contact.title'))
                    ->description(__('made-cms::cms.resources.settings.information.sections.contact.description'))
                    ->aside()
                    ->schema([
                        Repeater::make('contacts')
                            ->label('')
                            ->schema([
                                TextInput::make('key')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.key.label'))
                                    ->live(onBlur: true)
                                    ->required(),

                                TextInput::make('email')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.email.label'))
                                    ->required(),

                                TextInput::make('phoneNumber')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.phoneNumber.label'))
                                    ->required(),

                                TextInput::make('phone')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.phone.label')),

                                TextInput::make('contactPerson')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.contactPerson.label')),

                                TextInput::make('label')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.label.label')),
                            ])
                            ->addActionLabel(__('made-cms::cms.resources.settings.information.fields.contacts.actionLabel'))
                            ->minItems(1)
                            ->itemLabel(fn (array $state): ?string => $state['key'] ?? null)
                            ->collapsed(),

                    ]),

                Section::make(__('made-cms::cms.resources.settings.information.sections.account.title'))
                    ->description(__('made-cms::cms.resources.settings.information.sections.account.description'))
                    ->aside()
                    ->schema([
                        Repeater::make('accounts')
                            ->label('')
                            ->schema([
                                TextInput::make('key')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.key.label'))
                                    ->live(onBlur: true)
                                    ->required(),

                                TextInput::make('label')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.label.label'))
                                    ->live(onBlur: true)
                                    ->required(),

                                TextInput::make('account')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.account.label'))
                                    ->required(),

                                TextInput::make('url')
                                    ->label(__('made-cms::cms.resources.settings.information.fields.url.label')),
                            ])
                            ->addActionLabel(__('made-cms::cms.resources.settings.information.fields.accounts.actionLabel'))
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->collapsed(),
                    ]),
            ]);
    }

    /**
     * Retrieves the navigation label for the website settings.
     *
     * @return string The navigation label.
     */
    public static function getNavigationLabel(): string
    {
        return __('made-cms::cms.resources.settings.information.label');
    }

    /**
     * Retrieves and returns the navigation group string for website management.
     *
     * @return string The navigation group string.
     */
    public static function getNavigationGroup(): string
    {
        return __('made-cms::cms.navigation_groups.information');
    }

    /**
     * Get the title of the information settings page.
     *
     * @return string|Htmlable The title of the page, which can be a plain string or an instance of Htmlable.
     */
    public function getTitle(): string | Htmlable
    {
        return __('made-cms::cms.resources.settings.information.title');
    }
}