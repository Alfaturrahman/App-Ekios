<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JabatanMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Gunakan guard 'employee'
        $user = auth('employee')->user();

        if (!$user || !$user->jabatan) {
            abort(403, 'Unauthorized - No Jabatan');
        }

        $namaJabatan = strtolower($user->jabatan->name);

        foreach ($roles as $role) {
            if ($namaJabatan === strtolower($role)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized - Role mismatch');
    }
}
