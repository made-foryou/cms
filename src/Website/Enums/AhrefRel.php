<?php

declare(strict_types=1);

namespace Made\Cms\Website\Enums;

enum AhrefRel: string
{
    /**
     * Alternate representations of the current document.
     *
     * @group Link
     */
    case Alternate = 'alternate';

    /**
     * Author of the current document or article.
     *
     * @group Link
     */
    case Author = 'author';

    /**
     * Permalink for the nearest ancestor section.
     *
     * @group Link
     */
    case Bookmark = 'bookmark';

    /**
     * Link to context-sensitive help.
     *
     * @group Link
     */
    case Help = 'help';

    /**
     * Indicates that the main content of the current document is covered by the copyright
     * license described by the referenced document.
     *
     * @group Link
     */
    case License = 'license';

    /**
     * Indicates that the current document represents the person who owns the linked content.
     *
     * @group Link
     */
    case Me = 'me';

    /**
     * Indicates that the current document is a part of a series and that the next document in
     * the series is the referenced document.
     *
     * @group Link
     */
    case Next = 'next';

    /**
     * Indicates that the current document is a part of a series and that the previous document
     * in the series is the referenced document.
     *
     * @group Link
     */
    case Prev = 'prev';

    /**
     * Gives a link to a information about the data collection and usage practices that apply
     * to the current document.
     *
     * @group Link
     */
    case PrivacyPolicy = 'privacy-policy';

    /**
     * Gives a link to a resource that can be used to search through the current document and
     * its related pages.
     *
     * @group Link
     */
    case Search = 'search';

    /**
     * Gives a tag (identified by the given address) that applies to the current document.
     *
     * @group Link
     */
    case Tag = 'tag';

    /**
     * Link to the agreement, or terms of service, between the document's provider and users who
     * wish to use the document.
     *
     * @group Link
     */
    case TermsOfService = 'terms-of-service';

    /**
     * Indicates that the current document's original author or publisher does not endorse the
     * referenced document.
     *
     * @group Annotation
     */
    case NoFollow = 'nofollow';

    /**
     * Creates a top-level browsing context that is not an auxiliary browsing context if the
     * hyperlink would create either of those, to begin with (i.e., has an appropriate
     * target attribute value).
     *
     * @group Annotation
     */
    case NoOpener = 'noopener';

    /**
     * No Referer header will be included. Additionally, has the same effect as noopener.
     *
     * @group Annotation
     */
    case NoReferrer = 'noreferrer';

    /**
     * Creates an auxiliary browsing context if the hyperlink would otherwise create a top-level
     * browsing context that is not an auxiliary browsing context (i.e., has "_blank" as target
     * attribute value).
     *
     * @group Annotation
     */
    case Opener = 'opener';

    /**
     * The referenced document is not part of the same site as the current document.
     *
     * @group Annotation
     */
    case External = 'external';

    /**
     * Returns whether the option is selectable as a rel for the Menu item links.
     */
    public function isSelectableForMenuItems(): bool
    {
        return match ($this) {
            self::External, self::NoFollow, self::NoOpener, self::NoReferrer, self::Opener,
            self::PrivacyPolicy, self::TermsOfService => true,
            default => false,
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::External => 'external - Externe link',
            self::NoFollow => 'nofollow - Niet volgbare link',
            self::NoOpener => 'noopener - Geen opener link',
            self::NoReferrer => 'noreferrer - Geen referrer link',
            self::Opener => 'opener - Opener link',
            self::PrivacyPolicy => 'privacy-policy - Privacybeleid',
            self::TermsOfService => 'terms-of-service - Gebruiksvoorwaarden',
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::External => 'Het document waarnaar wordt verwezen maakt geen deel uit van dezelfde site als het huidige document.',
            self::NoFollow => 'Geeft aan dat de oorspronkelijke auteur of uitgever van het huidige document het document waarnaar wordt verwezen niet onderschrijft.',
            self::NoOpener => 'Creëert een bladercontext op het hoogste niveau die geen hulpbladercontext is als de hyperlink om te beginnen een van die contexten zou creëren (d.w.z. een geschikte doelattribuutwaarde heeft).',
            self::NoReferrer => 'De website die wordt geladen in een nieuw tabblad zal geen toegang krijgen tot informatie van de originele website waar een bezoeker vandaan komt.',
            self::Opener => 'Creëert een extra bladercontext als de hyperlink anders een bladercontext op het hoogste niveau zou creëren die geen extra bladercontext is (d.w.z. “_blank” als doelattribuutwaarde heeft).',
            self::PrivacyPolicy => 'Geeft een link naar informatie over het verzamelen en gebruiken van gegevens die van toepassing zijn op het huidige document.',
            self::TermsOfService => 'Link naar de overeenkomst of servicevoorwaarden tussen de aanbieder van het document en gebruikers die het document willen gebruiken.',
        };
    }
}
