<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Category;

class verifyCategoryCount
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
        if(Category::all()->count() == 0)
        {
            return redirect()
                ->route('categories.create')
                ->with('error-message', 'No categories found! You need to create category in order to create post');
        }
        return $next($request);
    }
}
