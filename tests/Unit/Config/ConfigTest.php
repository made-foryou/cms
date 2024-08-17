<?php

test('it has a panel path setting', function () {
    expect(config('made-cms.panel.path'))
        ->toBe('made');
});
