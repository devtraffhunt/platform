<?php

namespace App\DTO\Auth;

use App\DTO\BaseDTO;

class RegisterQuickDTO extends BaseDTO
{
    public function __construct(
        public ?string $first_name = null,
        public ?string $last_name = null,
        public string $email,
        public string $password,
        public string $phone,
        public ?int $affiliate_id = null,
        public ?string $telegram_id = null,
        public ?int $bonus_id = null,
        public ?int $game_id = null,
        public ?string $url = null,
        public ?string $domain = null,
        public ?string $sub1 = null,
        public ?string $sub2 = null,
        public ?string $sub3 = null,
        public ?string $sub4 = null,
        public ?string $sub5 = null,
    ) {}

    public static function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name'  => ['nullable', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'   => ['required', 'string', 'min:6'],
            'phone'      => ['required', 'string', 'regex:/^[0-9]{10,15}$/', 'unique:users,phone'],
            'affiliate_id' => ['nullable', 'integer'],
            'telegram_id'  => ['nullable', 'string', 'max:255'],
            'bonus_id'     => ['nullable', 'integer'],
            'game_id'      => ['nullable', 'integer'],
            'url'          => ['nullable', 'url', 'max:1024'],
            'domain' => ['nullable', 'string', 'max:255'],
            'sub1' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9_-]+$/'],
            'sub2' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9_-]+$/'],
            'sub3' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9_-]+$/'],
            'sub4' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9_-]+$/'],
            'sub5' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9_-]+$/'],
        ];
    }
}
