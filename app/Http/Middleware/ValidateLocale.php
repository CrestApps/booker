<?php

namespace App\Http\Middleware;

use App;
use Closure;

class ValidateLocale
{
    protected $apiName = 'api';

    /**
     * Handle an incoming request.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1);

        if (strtolower($locale) == $this->apiName) {
            return $next($request);
        }

        if (empty($locale) || !array_key_exists($locale, config('app.locales', ['en']))) {
            $segments = $request->segments();

            if (strlen($locale) != 2) {
                //if someone pass the wrong 2 char letters, redirect to the default
                array_unshift($segments, config('app.locale', 'en'));
            } else {
                // replace the first segment with the defaule language
                $segments[0] = config('app.locale');
            }

            return redirect(implode('/', $segments));
        }

        App::setLocale($locale);

        return $next($request);
    }
}
