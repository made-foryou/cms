<?php

declare(strict_types=1);

namespace Made\Cms\Page\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Made\Cms\Models\Page;
use Made\Cms\Shared\Enums\PublishingStatus;

class CreateCopyAction
{
    use AsAction;

    public function handle(Page $page): Page
    {
        $copy = new Page;

        $copy->name = $page->name;
        $copy->slug = $page->slug;
        $copy->status = PublishingStatus::Draft;
        $copy->content = $page->content;

        $copy->save();

        if ($page->meta !== null) {
            $copy->meta()->create([
                'title' => $page->meta->title,
                'description' => $page->meta->description,
                'robot' => $page->meta->robot,
                'canonicals' => $page->meta->canonicals,
            ]);
        }

        $copy->author()->associate(request()->user());
        $copy->language()->associate($page->language);

        if ($page->parent !== null) {
            $copy->parent()->associate($page->parent);
        }

        if ($page->translatedFrom !== null) {
            $copy->translatedFrom()->associate($page->translatedFrom);
        }

        $copy->save();
        $copy->refresh();

        return $copy;
    }
}
