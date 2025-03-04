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
                Section::make('Bedrijf / organisatie')
                    ->description('Gegevens van het bedrijf / de organisatie achter de website.')
                    ->aside()
                    ->schema([
                        TextInput::make('company')
                            ->label('Bedrijf / organisatie naam'),
                    ]),

                Section::make('Adressen')
                    ->description('Adresgegevens van de organisatie / het bedrijf van de website.')
                    ->aside()
                    ->schema([
                        Repeater::make('addresses')
                            ->label('')
                            ->schema([
                                TextInput::make('key')
                                    ->label('ID')
                                    ->live(onBlur: true)
                                    ->required(),

                                TextInput::make('address')
                                    ->label('Adres')
                                    ->required(),

                                TextInput::make('zipcode')
                                    ->label('Postcode')
                                    ->required(),

                                TextInput::make('city')
                                    ->label('Stad')
                                    ->required(),

                                TextInput::make('country')
                                    ->label('Land'),
                            ])
                            ->addActionLabel('Nieuw adres toevoegen')
                            ->minItems(1)
                            ->itemLabel(fn (array $state): ?string => $state['key'] ?? null)
                            ->collapsed(),
                    ]),

                Section::make('Contactgegevens')
                    ->description('Contactgegevens van de organisatie / het bedrijf van de website.')
                    ->aside()
                    ->schema([
                        Repeater::make('contacts')
                            ->label('')
                            ->schema([
                                TextInput::make('key')
                                    ->label('ID')
                                    ->live(onBlur: true)
                                    ->required(),

                                TextInput::make('email')
                                    ->label('E-mailadres')
                                    ->required(),

                                TextInput::make('phoneNumber')
                                    ->label('Telefoonnummer')
                                    ->required(),

                                TextInput::make('phone')
                                    ->label('Telefoonnummer presentatie'),

                                TextInput::make('contactPerson')
                                    ->label('Contactpersoon'),

                                TextInput::make('label')
                                    ->label('Naam / omschrijving'),
                            ])
                            ->addActionLabel('Nieuw contact toevoegen')
                            ->minItems(1)
                            ->itemLabel(fn (array $state): ?string => $state['key'] ?? null)
                            ->collapsed(),

                    ]),

                Section::make('Accounts')
                    ->description('Algemene gegevens zoals bankrekening nummers, social media accounts enz. welke je op de website wilt tonen.')
                    ->aside()
                    ->schema([
                        Repeater::make('accounts')
                            ->label('')
                            ->schema([
                                TextInput::make('key')
                                    ->label('ID')
                                    ->live(onBlur: true)
                                    ->required(),

                                TextInput::make('label')
                                    ->label('Naam')
                                    ->live(onBlur: true)
                                    ->required(),

                                TextInput::make('account')
                                    ->label('Nummer / account naam')
                                    ->required(),

                                TextInput::make('url')
                                    ->label('(evt). Link naar het account'),
                            ])
                            ->addActionLabel('Nieuw account toevoegen')
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
