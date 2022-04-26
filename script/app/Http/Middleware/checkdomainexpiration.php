<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkdomainexpiration
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
               $user_id=domain_info('user_id');
               $Domain=Domain::where('user_id',$user_id)->first();
               if ($Domain->status) 
               {
                   return $next($request); 
               }
               else
               {
                  return  view('expired',compact('Domain'));
               }

        
    }
}
