<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $auth = [
            'admin' => auth('admin')->check(),
            'web' => auth('user')->check(),
        ];
        if ($request->is('admin*')) {
            if(!$auth['admin'])
            {
                return route('admin.login');
            }
        }
        else
        {
            if(!$auth['web'])
            {
                return route('login');
            }
        }
        return null;
    }
}
