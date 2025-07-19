<?php
namespace App\Http\Middleware;

use App\Traits\JsonResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    use JsonResponse ;

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
          return $this->failResponse(
            'Unauthorized',
            401,
            'You must be logged in to access this resource.'
          );
        }

        return $next($request);
    }
}
