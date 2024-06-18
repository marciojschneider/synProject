<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Adicionais
use Illuminate\Support\Facades\Route;

// Models
use App\Models\profilePermission;
use App\Models\UserProfile;

class canAccess {
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response {
    $routeName = Route::currentRouteName();

    if (!auth()->check()) {
      return redirect()->route('login');
    }

    $user = auth()->user();

    $sql = UserProfile::where('user_id', $user->id)
      ->where('client_id', $user->in_client)
      ->where('profile_id', $user->in_profile)
      ->where('situation', 1)
      ->get();

    $checkExistence = json_decode($sql, true);

    if (count($checkExistence) !== 1) {
      return redirect()->route('login');
    }

    $arr = explode('-', $routeName);

    $sqlPermission = profilePermission::where('profile_permissions.profile_id', $user->in_profile)
      ->join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id')
      ->where('sidebars.module', 'like', '%' . $arr[1] . '%')
      ->get();

    if (count($sqlPermission) !== 1) {
      return redirect()->route('no-permission');
    }

    return $next($request);
  }
}
