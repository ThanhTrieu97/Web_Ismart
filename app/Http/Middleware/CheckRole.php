<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $users = Auth::user();
        if($users->role->name=='Subcriber')
            return redirect('dashboard')->with('status_danger', 'Bạn không có quyền thực thi phương thức này');
        return $next($request);
    }
}
