<?php

namespace App\Http\Middleware;

use App\Models\UserProfile;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class canAccess {
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response {
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

    return $next($request);
  }
}
