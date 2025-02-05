<?php

namespace Made\Cms\Analytics\Http\Middleware;

use Closure;
use foroco\BrowserDetection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Made\Cms\Analytics\Models\Visit;

class RegisterVisitMiddleware
{
    public function handle(Request $request, Closure $next)
    {
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
}
