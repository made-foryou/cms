<?php

namespace Made\Cms\Filament\Builder;

use Filament\Forms\Components\Builder\Block;
use Illuminate\Contracts\View\View;

/**
 * #### Content strip
 *
 * Use this interface to add content strips to the cms and website. This
 * content strip must then also be registered in the made-cms
 * configuration.
 */
interface ContentStrip
{
    /**
     * Returns unique id for this content strip. The content strip is being
     * identified by this id.
     *
     * @return string A unique ID as a string.
     */
    public static function id(): string;

    /**
     * Creates the block component which can be added to the “Builder” field
     * in the filament cms panel.
     *
     * @return Block A new Block instance.
     */
    public static function block(string $context = 'form'): Block;

    /**
     * Generates the html implementation of the content strip which can be
     * used in the website.
     *
     * @param  array  $arguments  Optional arguments to be passed to the view.
     * @return View The rendered view instance.
     */
    public static function render(array $arguments = []): View;
}
