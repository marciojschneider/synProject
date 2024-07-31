<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Imports Adicionais
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  // Adicionais
  public function client() {
    return $this->belongsTo(Client::class, 'in_client');
  }

  public function cClients() {
    return $this->hasMany(UserProfile::class, 'user_id')->groupBy('client_id')->where('situation', 1)->select('client_id');
  }

  public function profile() {
    return $this->belongsTo(Profile::class, 'in_profile');
  }
  public function cProfiles() {
    return $this->hasMany(UserProfile::class, 'user_id')->where('client_id', auth()->user()->in_client)->where('situation', 1);
  }
}
