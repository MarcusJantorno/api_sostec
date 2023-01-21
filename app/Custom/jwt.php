<?php

namespace App\Custom;

use App\Models\User as User;
use Firebase\JWT\JWT as JWTFirebase;

class Jwt
{
  public static function validate(){

  }

  public static function create(User $data){
    $key = $_ENV['JWT_KEY'];

    $payload = [
      'exp' => time() + 1800,
      'iat' => time(),
      'data' => $data
    ];

    return JWTFirebase::encode($payload, $key, 'HS256');
  }
}


