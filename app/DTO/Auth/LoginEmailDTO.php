<?php

namespace App\DTO\Auth;

use App\DTO\BaseDTO;

class LoginEmailDTO extends BaseDTO
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}

    public static function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
