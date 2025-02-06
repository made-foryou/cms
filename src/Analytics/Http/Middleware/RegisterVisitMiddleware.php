<?php

namespace Made\Cms\Analytics\Http\Middleware;

use Closure;
use foroco\BrowserDetection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Made\Cms\Analytics\Models\Settings\AnalyticsSettings;
use Made\Cms\Analytics\Models\Visit;

readonly class RegisterVisitMiddleware
{
    /**
     * Constructor method for initializing the class.
     *
     * @param  AnalyticsSettings  $settings  An instance of AnalyticsSettings to configure analytics behavior.
     * @return void
     */
    public function __construct(
        protected AnalyticsSettings $settings,
    ) {}

    /**
     * Handles an incoming HTTP request, logs the visit details, and attaches the visit data to the request.
     *
     * @param  Request  $request  The HTTP request instance.
     * @param  Closure  $next  The middleware closure to proceed to the next middleware.
     * @return mixed Proceeds with the request and response flow.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (config('app.env') === 'local') {
            return $next($request);
        }

        if ($this->isIpBlacklisted($request)) {
            return $next($request);
        }

        $userAgentData = (new BrowserDetection)->getAll($request->userAgent());

        $visit = Visit::create([
            'session' => Session::id(),
            'user_agent' => $request->userAgent(),
            'browser' => $userAgentData['browser_name'] ?? null,
            'browser_version' => $userAgentData['browser_version'] ?? null,
            'platform' => $userAgentData['os_name'] ?? null,
            'is_desktop' => $userAgentData['os_type'] === 'desktop',
            'referer' => $request->headers->get('referer'),
            'request' => $request->getRequestUri(),
        ]);

        if (! empty($request->user())) {
            $visit->user()->associate($request->user());
        }

        if (! empty($request->user('made'))) {
            $visit->user()->associate($request->user('made'));
        }

        $visit->save();
        $visit->refresh();

        $request->merge(['visit' => $visit]);

        return $next($request);
    }

    /**
     * Checks if the given IP address is blacklisted.
     *
     * @param  Request  $request  The HTTP request object containing the IP address to check.
     * @return bool Returns true if the IP address is blacklisted, otherwise false.
     */
    public function isIpBlacklisted(Request $request): bool
    {
        return in_array($request->ip(), $this->settings->ip_blacklist);
    }
}
