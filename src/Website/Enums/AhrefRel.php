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
     * Mark links that are advertisements or paid placements (commonly called paid links) with
     * the sponsored value. Read more about Google's stance on paid links.
     *
     * @group Link
     */
    case Sponsored = 'sponsored';

    /**
     * We recommend marking user-generated content (UGC) links, such as comments and forum
     * posts, with the ugc value.
     *
     * @group Link
     */
    case Ugc = 'ugc';

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
            self::External => __('made-cms::cms.enums.ahrefrel.external.label'),
            self::NoFollow => __('made-cms::cms.enums.ahrefrel.nofollow.label'),
            self::NoOpener => __('made-cms::cms.enums.ahrefrel.noopener.label'),
            self::NoReferrer => __('made-cms::cms.enums.ahrefrel.noreferrer.label'),
            self::Opener => __('made-cms::cms.enums.ahrefrel.opener.label'),
            self::PrivacyPolicy => __('made-cms::cms.enums.ahrefrel.privacy-policy.label'),
            self::TermsOfService => __('made-cms::cms.enums.ahrefrel.terms-of-service.label'),
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::External => __('made-cms::cms.enums.ahrefrel.external.description'),
            self::NoFollow => __('made-cms::cms.enums.ahrefrel.nofollow.description'),
            self::NoOpener => __('made-cms::cms.enums.ahrefrel.noopener.description'),
            self::NoReferrer => __('made-cms::cms.enums.ahrefrel.noreferrer.description'),
            self::Opener => __('made-cms::cms.enums.ahrefrel.opener.description'),
            self::PrivacyPolicy => __('made-cms::cms.enums.ahrefrel.privacy-policy.description'),
            self::TermsOfService => __('made-cms::cms.enums.ahrefrel.terms-of-service.description'),
        };
    }
}
