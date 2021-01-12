<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfSessionHasPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            return redirect()->route('admin.index');
        }

        if (!session()->has('plan')) {
            return redirect()
                ->route('site.home')
                ->with('warning', 'Selecione um plano antes de se registrar!');
        }

        return $next($request);
    }
}
