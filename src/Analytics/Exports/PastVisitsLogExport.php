<?php

namespace Made\Cms\Analytics\Exports;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Made\Cms\Analytics\Enums\VisitSavingStrategy;
use Made\Cms\Analytics\Models\Visit;

readonly class PastVisitsLogExport implements FromCollection
{
    /**
     * Constructor for initializing the VisitSavingStrategy.
     *
     * @param  VisitSavingStrategy  $strategy  An instance of VisitSavingStrategy to handle visit saving logic.
     */
    public function __construct(
        protected VisitSavingStrategy $strategy,
    ) {}

    /**
     * Retrieves a collection of visits that are filtered based on a threshold date defined by the strategy.
     *
     * @return Collection|\Illuminate\Support\Collection A collection of visits retrieved from the database.
     *
     * @throws Exception When the strategy does not delete any visit logs.
     */
    public function collection(): Collection | \Illuminate\Support\Collection
    {
        return Visit::query()
            ->pastThreshold($this->strategy->getThresholdDate())
            ->get();
    }
}
