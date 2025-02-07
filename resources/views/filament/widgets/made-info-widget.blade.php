<x-filament-widgets::widget class="fi-filament-info-widget">
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <div class="flex-1 flex justify-between items-center">
                <span class="inline-block font-bold text-gray-950 leading-5 text-xl dark:text-white">
                    Made <span class="font-normal text-lg">for you</span>
                </span>


                <span class="inline-block text-lg text-gray-500 dark:text-gray-400">
                    {{ \Composer\InstalledVersions::getPrettyVersion('made-foryou/cms') }}
                </span>
            </div>

            <div class="flex flex-col items-end gap-y-1">

            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
