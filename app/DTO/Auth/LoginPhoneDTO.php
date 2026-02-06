<?php

namespace App\DTO\Auth;

use App\DTO\BaseDTO;

class LoginPhoneDTO extends BaseDTO
{
    public function __construct(
        public string $phone,
        public string $password,
    ) {}

    public static function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
            'password' => ['required', 'string'],
        ];
    }
}
