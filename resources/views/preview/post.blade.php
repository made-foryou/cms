@if ($record && $record->content)
    {!! \Made\Cms\Facades\Cms::renderContentStrips($record->content) !!}
@endif