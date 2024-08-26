<?php

namespace App\Http\Middleware;

use App\Models\Sidebar;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Adicionais
use Illuminate\Support\Facades\Route;

// Models
use App\Models\ProfilePermission;
use App\Models\UserProfile;

class canAccess {
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response {
    $routeName = Route::getCurrentRoute();
    $arrRoute = explode('/', $routeName->uri);

    if (count($arrRoute) > 1) {
      $stringRoute = $arrRoute[0] . '/' . $arrRoute[1];
    } else {
      $stringRoute = $arrRoute[0];
    }

    if (!auth()->check()) {
      return redirect()->route('login');
    }

    $user = auth()->user();

    $checkExistence = UserProfile::where('user_id', $user->id)
      ->where('client_id', $user->in_client)
      ->where('profile_id', $user->in_profile)
      ->where('situation', 1)
      ->get();

    if (count($checkExistence) !== 1) {
      return redirect()->route('login');
    }

    if (Route::currentRouteName() === 'homepage') {
      return $next($request);
    }
    // dd($stringRoute);

    $sqlPermission = ProfilePermission::join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id')
      ->where('profile_permissions.profile_id', $user->in_profile)
      ->where('sidebars.url', 'like', '%' . $stringRoute . '%')
      ->where('sidebars.client_id', 'REGEXP', '[[:<:]]' . $user->in_client . '[[:>:]]')
      ->where('profile_permissions.view', 1)
      ->get();

    if (!isset($sqlPermission[0]) || count($sqlPermission) === 0) {
      return redirect()->route('no-permission');
    }

    if (isset($arrRoute[2])) {
      if ($sqlPermission[0][$arrRoute[2]] === 0) {
        return redirect()->route('no-permission');
      }
    }

    return $next($request);
  }
}
