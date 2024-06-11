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
}
