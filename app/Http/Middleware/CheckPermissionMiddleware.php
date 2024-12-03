<?php

namespace App\Http\Middleware;

use App\Http\Services\ApiResponseService;
use App\Models\File;
use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $array = explode('/', request()->getUri());
        $file=(end($array));
        $task=Task::find($file);
        if($task->user_id==auth()->user()->id){
            return $next($request);
        }
        return ApiResponseService::errorMsgResponse(trans('response.unauthorized'));
    }
}
