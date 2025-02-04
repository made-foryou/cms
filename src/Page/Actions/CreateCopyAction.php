<?php

declare(strict_types=1);

namespace Made\Cms\Page\Actions;

use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;
use Made\Cms\Models\User;
use Made\Cms\Shared\Contracts\HasMeta;
use Made\Cms\Shared\Enums\PublishingStatus;

/**
 * @method static Model run(Model $page, User $user)
 */
class CreateCopyAction
{
    use AsAction;

    public function handle(Model $model, User $user): Model
    {
        $copy = $model->replicate()->fill([
            'status' => PublishingStatus::Draft,
            'created_by' => $user->id,
            'language_id' => $model->language_id,
        ]);

        $copy->save();

        if ($model instanceof HasMeta && $model->meta !== null) {
            $copy->meta()->create([
                'title' => $model->meta->title,
                'description' => $model->meta->description,
                'robot' => $model->meta->robot,
                'canonicals' => $model->meta->canonicals,
            ]);
        }

        $copy->createdBy()->associate($user);
        $copy->language()->associate($model->language);

        if ($model->parent !== null) {
            $copy->parent()->associate($model->parent);
        }

        if ($model->translatedFrom !== null) {
            $copy->translatedFrom()->associate($model->translatedFrom);
        }

        $copy->save();
        $copy->refresh();

        return $copy;
    }
}
