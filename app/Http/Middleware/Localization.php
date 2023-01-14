<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
       if (\Session::has('locale')) {
            \App::setlocale(\Session::get('locale'));
            session(['lang' => $this->langs(app()->getLocale())]);
       }
       return $next($request);
    }

    protected function langs($lang)
    {
        $list = [
            'en' => 'English',
            'ar' => 'العربية',
            'fr' => 'France',
        ];

        if (!array_key_exists($lang, $list)) {
            return app()->getLocale();
        }

        return $list[$lang];
    }


}
