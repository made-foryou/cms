<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Made\Cms\Analytics\Http\Middleware\RegisterVisitMiddleware;
use Made\Cms\Analytics\Models\Settings\AnalyticsSettings;
use Made\Cms\Analytics\Models\Visit;

uses(RefreshDatabase::class);

test('does not log visit when environment is local', function () {
    config()->set('app.env', 'local');

    $settings = mock(AnalyticsSettings::class);
    $middleware = new RegisterVisitMiddleware($settings);

    $next = fn ($request) => 'next-called';

    $request = new Request;

    $response = $middleware->handle($request, $next);

    expect($response)->toBe('next-called');
    expect(Visit::all())->toBeEmpty();
});

test('does not log visit when IP is blacklisted', function () {
    Config::set('app.env', 'production');

    $settings = mock(AnalyticsSettings::class);
    $settings->ip_blacklist = ['127.0.0.1'];

    $middleware = new RegisterVisitMiddleware($settings);

    $next = fn ($request) => 'next-called';

    $request = new Request(server: [
        'REMOTE_ADDR' => '127.0.0.1',
        'HTTP_USER_AGENT' => 'Mozilla/5.0 (platform; rv:gecko-version) Gecko/gecko-trail Firefox/firefox-version',
    ]);

    $response = $middleware->handle($request, $next);

    expect($response)->toBe('next-called');
    expect(Visit::all())->toBeEmpty();
});

test('logs visit when conditions are met', function () {
    Config::set('app.env', 'production');

    $settings = mock(AnalyticsSettings::class);
    $settings->ip_blacklist = [];

    $middleware = new RegisterVisitMiddleware($settings);

    $request = new Request(server: [
        'HTTP_USER_AGENT' => 'Mozilla/5.0',
        'HTTP_REFERER' => 'https://example.com',
    ]);
    $request->setUserResolver(fn () => null);

    $next = fn ($request) => 'next-called';

    $response = $middleware->handle($request, $next);

    $visit = Visit::first();

    expect($response)->toBe('next-called')
        ->and($visit)->not->toBeNull()
        ->and(Hash::check(Session::id(), $visit->session))->toBeTrue()
        ->and($visit->user_agent)->toBe('Mozilla/5.0')
        ->and($visit->referer)->toBe('https://example.com')
        ->and($visit->request)->toBe($request->getRequestUri());
});
